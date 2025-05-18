<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cobranza;
use App\Models\CobranzaContratoServicio;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::where('estado_cliente', '!=', 'inactivo')->get();
        $query = Cobranza::with(['cliente', 'usuario']);

        // Filtrar por usuario si no es administrador
        if (!auth()->user()->hasRole('administrador')) {
            $query->where('usuario_id', auth()->id());
        }

        // Aplicar filtro de búsqueda si existe
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_boleta', 'like', "%{$search}%")
                  ->orWhereHas('cliente', function($q) use ($search) {
                      $q->where('nombres', 'like', "%{$search}%")
                        ->orWhere('apellidos', 'like', "%{$search}%")
                        ->orWhere('identificacion', 'like', "%{$search}%");
                  });
            });
        }

        // Aplicar filtros de fecha solo si no se pidió ver todos
        if (!$request->has('todos')) {
            if ($request->has('fecha_inicio') && $request->has('fecha_fin')) {
                $query->whereBetween('fecha_cobro', [
                    $request->fecha_inicio,
                    $request->fecha_fin
                ]);
            } elseif ($request->has('fecha_inicio')) {
                $query->whereDate('fecha_cobro', $request->fecha_inicio);
            } else {
                // Si no hay filtros de fecha y no se pidió ver todos, mostrar solo los del día actual
                $query->whereDate('fecha_cobro', now()->format('Y-m-d'));
            }
        }

        $cobranzas = $query->orderBy('created_at', 'desc')->get();
        $usuarios = User::whereHas('cobranzas')->get();

        return view('payments.index', compact('cobranzas', 'clientes', 'usuarios'));
    }    

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validar los datos del request
            $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'monto_total' => 'required|numeric|min:0',
                'monto_pago_efectivo' => 'required|numeric|min:0',
                'tipo_pago' => 'required|in:efectivo,deposito',
                'glosa' => 'nullable|string',
                'detalles' => 'required|array',
                'detalles.*.contrato_servicio_id' => 'required|exists:contrato_servicio,id',
                'detalles.*.mes_id' => 'required|exists:meses,id',
                'detalles.*.monto_pagado' => 'required|numeric|min:0',
                'detalles.*.estado_pago' => 'required|in:pendiente,pagado,anulado,no_aplica'
            ]);

            // Crear la cobranza
            $cobranza = Cobranza::create([
                'cliente_id' => $request->cliente_id,
                'usuario_id' => auth()->id(),
                'monto_total' => $request->monto_total,
                'monto_pago_efectivo' => $request->monto_pago_efectivo,
                'monto_cambio_efectivo' => $request->monto_pago_efectivo - $request->monto_total,
                'tipo_pago' => $request->tipo_pago,
                'fecha_cobro' => now(),
                'estado_cobro' => 'emitido',
                'glosa' => $request->glosa
            ]);

            // Crear los detalles de la cobranza
            foreach ($request->detalles as $detalle) {
                CobranzaContratoServicio::create([
                    'cobranza_id' => $cobranza->id,
                    'contrato_servicio_id' => $detalle['contrato_servicio_id'],
                    'mes_id' => $detalle['mes_id'],
                    'monto_pagado' => $detalle['monto_pagado'],
                    'estado_pago' => $detalle['estado_pago']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cobro registrado exitosamente',
                'cobranza_id' => $cobranza->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el cobro: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function show(string $id)
    {
        try {
            $cobranza = Cobranza::with([
                'cliente',
                'usuario',
                'cobranzaContratoServicios.contratoServicio.servicio',
                'cobranzaContratoServicios.contratoServicio.plan',
                'cobranzaContratoServicios.mes'
            ])->findOrFail($id);

            // Capturar la fecha de cobro fuera del mapeo
            $fechaCobro = $cobranza->fecha_cobro->format('d/m/Y');

            return response()->json([
                'success' => true,
                'data' => [
                    'cobranza' => [
                        'numero_boleta' => $cobranza->numero_boleta,
                        'tipo_pago' => $cobranza->tipo_pago,
                        'glosa' => $cobranza->glosa,
                        'fecha_cobro' => $fechaCobro,
                        'estado_cobro' => $cobranza->estado_cobro,
                        'monto_total' => number_format($cobranza->monto_total, 2),
                        'monto_pago_efectivo' => number_format($cobranza->monto_pago_efectivo, 2),
                        'monto_cambio_efectivo' => number_format($cobranza->monto_cambio_efectivo, 2),
                        'usuario' => [
                            'name' => $cobranza->usuario->name
                        ]
                    ],
                    'cliente' => [
                        'nombres' => $cobranza->cliente->nombres . ' ' . $cobranza->cliente->apellidos,
                        'identificacion' => $cobranza->cliente->identificacion,
                        'telefono' => $cobranza->cliente->telefono
                    ],
                    'detalles' => $cobranza->cobranzaContratoServicios->map(function($detalle) {
                        return [
                            'servicio' => $detalle->contratoServicio->servicio->nombre . ' - ' . $detalle->contratoServicio->plan->nombre,
                            'mes' => $detalle->mes->nombre . ' ' . $detalle->mes->anio,
                            'monto_pagado' => number_format($detalle->monto_pagado, 2),
                            'estado_pago' => $detalle->estado_pago
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los detalles del pago: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $cobranza = Cobranza::findOrFail($id);
            
            // Verificar si el pago ya está anulado
            if ($cobranza->estado_cobro === 'anulado') {
                return response()->json([
                    'success' => false,
                    'message' => 'El pago ya se encuentra anulado.'
                ], 400);
            }

            // Actualizar el estado del pago a anulado
            $cobranza->estado_cobro = 'anulado';
            $cobranza->save();

            // Actualizar el estado de los detalles del pago
            $cobranza->cobranzaContratoServicios()->update(['estado_pago' => 'anulado']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pago anulado correctamente.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al anular el pago: ' . $e->getMessage()
            ], 500);
        }
    }

    public function anular($id)
    {
        try {
            DB::beginTransaction();

            // Buscar la cobranza
            $cobranza = Cobranza::findOrFail($id);

            // Verificar que no esté ya anulada
            if ($cobranza->estado_cobro === 'anulado') {
                return response()->json([
                    'success' => false,
                    'message' => 'El pago ya se encuentra anulado'
                ], 400);
            }

            // Actualizar estado de la cobranza
            $cobranza->update([
                'estado_cobro' => 'anulado'
            ]);

            // Actualizar estado de los detalles
            $cobranza->cobranzaContratoServicios()->update([
                'estado_pago' => 'anulado'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pago anulado exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al anular el pago: ' . $e->getMessage()
            ], 500);
        }
    }
}
