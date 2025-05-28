<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Plan;
use App\Models\Contrato;
use App\Models\ContratoServicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $clientes = Cliente::where('estado_cliente', 'activo')->get();
        $categorias = Categoria::with('servicios.planes')->get();

        $search = $request->input('search');
        $estado = $request->input('estado');
        $query = Contrato::with(['cliente', 'servicios', 'contratoServicios']);

        if ($search) {
            // Extraer el número después del prefijo CTR- si existe
            $searchId = preg_replace('/^CTR-0*/', '', $search);

            $query->where(function ($q) use ($search, $searchId) {
                $q->where('id', 'LIKE', '%' . $searchId . '%')
                    ->orWhereHas('cliente', function ($query) use ($search) {
                        $query->where(DB::raw("CONCAT(nombres, ' ', apellidos)"), 'LIKE', '%' . $search . '%')
                            ->orWhere('nombres', 'LIKE', '%' . $search . '%')
                            ->orWhere('apellidos', 'LIKE', '%' . $search . '%');
                    });
            });
        }

        if ($estado && $estado !== 'todos') {
            $query->where('estado_contrato', $estado);
        }

        $contratos = $query->orderBy('created_at', 'desc')->paginate(7);

        foreach ($contratos as $contrato) {
            $contrato->detalles_servicios = $contrato->contratoServicios->map(function ($contratoServicio) {
                $fecha = $contratoServicio->fecha_servicio;
                $fechaObj = $fecha ? \Carbon\Carbon::parse($fecha) : null;
                $fechaSuspension = $contratoServicio->fecha_suspension_servicio;
                $fechaSuspensionObj = $fechaSuspension ? \Carbon\Carbon::parse($fechaSuspension) : null;

                return [
                    'nombre' => $contratoServicio->servicio->nombre,
                    'plan' => $contratoServicio->plan ? $contratoServicio->plan->nombre : 'N/A',
                    'ip_servicio' => $contratoServicio->ip_servicio,
                    'fecha_servicio' => $fechaObj ? $fechaObj->format('d-m-Y') : 'N/A',
                    'fecha_suspension_servicio' => $fechaSuspensionObj ? $fechaSuspensionObj->format('d-m-Y') : 'N/A',
                    'estado' => $contratoServicio->estado_servicio_cliente,
                    'precio' => $contratoServicio->plan ? $contratoServicio->plan->precio : 0
                ];
            });

            // Calcular el total solo de servicios activos
            $contrato->total = $contrato->contratoServicios
                ->where('estado_servicio_cliente', 'activo')
                ->sum(function ($contratoServicio) {
                    return $contratoServicio->plan ? $contratoServicio->plan->precio : 0;
                });
        }

        return view('contracts.index', compact('clientes', 'categorias', 'contratos', 'estado'));
    }

    public function update(Request $request, $id)
    {
        // Validación de datos
        $validated = $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:activo,suspendido',
            'observaciones' => 'nullable|string',
            'detalles_json' => 'required|json'
        ]);

        DB::beginTransaction();

        try {
            // Obtener el contrato
            $contrato = Contrato::findOrFail($id);

            // Actualizar datos principales del contrato
            $contrato->update([
                'fecha_contrato' => $validated['fecha'],
                'estado_contrato' => $validated['estado'],
                'observaciones' => $validated['observaciones'],
                'fecha_suspension_contrato' => $validated['estado'] === 'suspendido' ? now() : null
            ]);

            // Decodificar detalles JSON
            $detalles = json_decode($validated['detalles_json'], true);

            if (!is_array($detalles)) {
                throw new \Exception('Formato inválido para detalles del contrato');
            }

            // Eliminar servicios marcados para eliminación
            if (isset($detalles['serviciosAEliminar']) && is_array($detalles['serviciosAEliminar'])) {
                foreach ($detalles['serviciosAEliminar'] as $servicioId) {
                    $servicio = ContratoServicio::where('id', $servicioId)
                        ->where('contrato_id', $id)
                        ->first();

                    if ($servicio) {
                        $servicio->delete();
                    }
                }
            }

            // Actualizar o crear servicios
            foreach ($detalles['detalles'] as $detalle) {
                if (!isset($detalle['servicio_id']) || !isset($detalle['plan_id'])) {
                    continue;
                }

                if (isset($detalle['id'])) {
                    // Actualizar servicio existente
                    $servicioExistente = ContratoServicio::where('id', $detalle['id'])
                        ->where('contrato_id', $id)
                        ->first();

                    if ($servicioExistente) {
                        // Si el servicio ya está suspendido en la BD, no permitir cambiar a activo
                        if (
                            $servicioExistente->estado_servicio_cliente === 'suspendido' &&
                            $detalle['estado'] === 'activo'
                        ) {
                            continue; // Saltar este servicio
                        }

                        if ($detalle['estado'] === 'suspendido') {
                            // Solo actualizar la fecha si no existe una previa
                            $fechaSuspension = $servicioExistente->fecha_suspension_servicio ?
                                $servicioExistente->fecha_suspension_servicio :
                                now();

                            $servicioExistente->update([
                                'estado_servicio_cliente' => 'suspendido',
                                'fecha_suspension_servicio' => $fechaSuspension,
                                'ip_servicio' => $detalle['ip_servicio'] ?? null
                            ]);
                        } else if ($detalle['estado'] === 'activo') {
                            $servicioExistente->update([
                                'estado_servicio_cliente' => 'activo',
                                'fecha_suspension_servicio' => null,
                                'ip_servicio' => $detalle['ip_servicio'] ?? null
                            ]);
                        }
                    }
                } else {
                    // Crear nuevo servicio
                    ContratoServicio::create([
                        'contrato_id' => $id,
                        'categoria_id' => $detalle['categoria_id'],
                        'servicio_id' => $detalle['servicio_id'],
                        'plan_id' => $detalle['plan_id'],
                        'ip_servicio' => $detalle['ip_servicio'] ?? null,
                        'estado_servicio_cliente' => $detalle['estado'] ?? 'activo',
                        'fecha_servicio' => now(),
                        'fecha_suspension_servicio' => $detalle['estado'] === 'suspendido' ? now() : null
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('contracts.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Contrato actualizado con éxito'
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('contracts.index')
                ->withErrors($e->errors())
                ->withInput()
                ->with('errorDetails', 'Error en la validación. Por favor, complete todos los campos.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('contracts.index')
                ->withInput()
                ->with('errorDetails', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function obtenerPrecioPlan($contratoId, $servicioId)
    {
        $contrato = Contrato::with(['contratoServicios.plan'])
            ->where('id', $contratoId)
            ->first();

        if (!$contrato) {
            return response()->json(['error' => 'Contrato no encontrado'], 404);
        }

        $contratoServicio = $contrato->contratoServicios->where('servicio_id', $servicioId)->first();

        if (!$contratoServicio) {
            return response()->json(['error' => 'Servicio no encontrado en el contrato'], 404);
        }

        $precio = $contratoServicio->plan->precio ?? null;

        return response()->json(['precio' => $precio]);
    }

    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        $contrato->delete();

        return redirect()->route('contracts.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'Contrato eliminado con éxito'
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validación de los datos
            $validatedData = $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'fecha' => 'required|date',
                'servicio_id' => 'required|array',
                'servicio_id.*' => 'exists:servicios,id',
                'plan_id' => 'required|array',
                'plan_id.*' => 'exists:planes,id',
                'categoria_id' => 'required|array',
                'categoria_id.*' => 'exists:categorias,id',
                'estado' => 'required|string',
                'observaciones' => 'nullable|string|max:500',
                'ip_servicio' => 'nullable|array',
                'ip_servicio.*' => 'nullable|string|max:20',
                'fecha_servicio' => 'required|array',
                'fecha_servicio.*' => 'nullable|date',
            ]);

            // Creación del contrato
            $contrato = Contrato::create([
                'cliente_id' => $request->cliente_id,
                'fecha_contrato' => $request->fecha,
                'estado_contrato' => $request->estado,
                'observaciones' => $request->observaciones,
                'fecha_suspension_contrato' => $request->estado === 'suspendido' ? now() : null
            ]);

            // Asignación de servicios, planes, categorías y IP
            foreach ($request->servicio_id as $index => $servicio_id) {
                ContratoServicio::create([
                    'contrato_id' => $contrato->id,
                    'servicio_id' => $servicio_id,
                    'plan_id' => $request->plan_id[$index],
                    'categoria_id' => $request->categoria_id[$index],
                    'ip_servicio' => $request->ip_servicio[$index],
                    'fecha_servicio' => $request->fecha_servicio[$index] ?? now(),
                    'estado_servicio_cliente' => $request->estado,
                ]);
            }

            DB::commit();

            return redirect()->route('contracts.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Contrato registrado con éxito'
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('contracts.index')
                ->withErrors($e->errors())
                ->withInput()
                ->with('errorDetails', 'Error en la validación. Por favor, complete todos los campos.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('contracts.index')
                ->withInput()
                ->with('errorDetails', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function getCategorias()
    {
        return response()->json(Categoria::with('servicios.planes')->get());
    }

    public function getServicios($categoriaId)
    {
        $servicios = Servicio::where('categoria_id', $categoriaId)->with('planes')->get();
        return response()->json($servicios);
    }

    public function getPlanes($servicioId)
    {
        $planes = Plan::where('servicio_id', $servicioId)->get();
        return response()->json($planes);
    }
}
