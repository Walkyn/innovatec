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
    public function index()
    {
        $clientes = Cliente::where('estado_cliente', 'activo')->get();
        $categorias = Categoria::with('servicios.planes')->get();
        $contratos = Contrato::with(['cliente', 'servicios', 'contratoServicios'])->paginate(7);
    
        foreach ($contratos as $contrato) {
            $contrato->detalles_servicios = $contrato->contratoServicios->map(function ($contratoServicio) {
                $fecha = $contratoServicio->fecha_servicio;
                $fechaObj = $fecha ? \Carbon\Carbon::parse($fecha) : null;
                
                return [
                    'nombre' => $contratoServicio->servicio->nombre,
                    'plan' => $contratoServicio->plan ? $contratoServicio->plan->nombre : 'N/A',
                    'ip_servicio' => $contratoServicio->ip_servicio,
                    'fecha' => $fechaObj ? $fechaObj->format('d-m-Y') : null,
                    'mes' => $fechaObj ? $fechaObj->format('F') : null,
                    'estado' => $contratoServicio->estado_servicio_cliente,
                    'precio' => $contratoServicio->plan ? $contratoServicio->plan->precio : 0
                ];
            });
        }
    
        return view('contracts.index', compact('clientes', 'categorias', 'contratos'));
    }

    public function edit($id)
    {
        $contrato = Contrato::with(['cliente', 'contratoServicios.servicio', 'contratoServicios.plan', 'contratoServicios.categoria'])->findOrFail($id);
        
        $detalles = $contrato->contratoServicios->map(function ($servicio) {
            return [
                'id' => $servicio->id,
                'categoria_id' => $servicio->categoria_id,
                'servicio_id' => $servicio->servicio_id,
                'plan_id' => $servicio->plan_id,
                'ip_servicio' => $servicio->ip_servicio,
                'precio' => $servicio->plan->precio,
                'categoria_nombre' => $servicio->categoria->nombre,
                'servicio_nombre' => $servicio->servicio->nombre,
                'plan_nombre' => $servicio->plan->nombre
            ];
        });

        return response()->json([
            'contrato' => $contrato,
            'detalles' => $detalles,
            'categorias' => Categoria::with('servicios.planes')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'fecha' => 'required|date',
                'estado' => 'required|in:activo,suspendido',
                'observaciones' => 'nullable|string',
                'detalles' => 'required|array',
                'detalles.*.servicio_id' => 'required|exists:servicios,id',
                'detalles.*.plan_id' => 'required|exists:planes,id',
                'detalles.*.categoria_id' => 'required|exists:categorias,id',
                'detalles.*.ip_servicio' => 'nullable|string',
                'detalles.*.estado' => 'required|in:activo,suspendido',
                'detalles.*.precio' => 'required|numeric'
            ]);

            // Obtener el contrato
            $contrato = Contrato::findOrFail($id);

            // Actualizar el contrato con los datos validados
            $contrato->update([
                'fecha_contrato' => $request->fecha,
                'estado_contrato' => $request->estado,
                'observaciones' => $request->observaciones
            ]);

            // Registrar los datos recibidos para depuración
            \Illuminate\Support\Facades\Log::info('Datos recibidos en update:', [
                'fecha' => $request->fecha,
                'estado' => $request->estado,
                'observaciones' => $request->observaciones,
                'detalles' => $request->detalles
            ]);

            // Iniciar transacción para asegurar la integridad de los datos
            DB::beginTransaction();

            try {
                // Eliminar todos los servicios existentes del contrato
                ContratoServicio::where('contrato_id', $id)->delete();

                // Crear nuevos registros para cada detalle
                foreach ($request->detalles as $detalle) {
                    // Asegurarse de que el detalle sea un array
                    $detalleData = is_array($detalle) ? $detalle : json_decode($detalle, true);
                    
                    // Registrar el detalle para depuración
                    \Illuminate\Support\Facades\Log::info('Procesando detalle:', $detalleData);
                    
                    // Verificar que el detalle tenga los campos necesarios
                    if (!isset($detalleData['servicio_id']) || !isset($detalleData['plan_id']) || !isset($detalleData['categoria_id'])) {
                        \Illuminate\Support\Facades\Log::warning('Detalle incompleto:', $detalleData);
                        continue;
                    }

                    // Crear nuevo registro de ContratoServicio
                    ContratoServicio::create([
                        'contrato_id' => $id,
                        'servicio_id' => $detalleData['servicio_id'],
                        'plan_id' => $detalleData['plan_id'],
                        'categoria_id' => $detalleData['categoria_id'],
                        'ip_servicio' => $detalleData['ip_servicio'] ?? null,
                        'estado_servicio_cliente' => $detalleData['estado'] ?? 'activo',
                        'fecha_servicio' => now()
                    ]);
                    
                    // Registrar la creación para depuración
                    \Illuminate\Support\Facades\Log::info('Servicio creado:', [
                        'servicio_id' => $detalleData['servicio_id'],
                        'plan_id' => $detalleData['plan_id'],
                        'categoria_id' => $detalleData['categoria_id'],
                        'ip_servicio' => $detalleData['ip_servicio'] ?? null,
                        'estado' => $detalleData['estado'] ?? 'activo'
                    ]);
                }

                // Confirmar la transacción
                DB::commit();

                return redirect()->route('contracts.index')->with([
                    'successMessage' => 'Éxito',
                    'successDetails' => 'Contrato actualizado con éxito'
                ]);

            } catch (\Exception $e) {
                // Revertir la transacción en caso de error
                DB::rollBack();
                throw $e;
            }

        } catch (ValidationException $e) {
            return redirect()->route('contracts.index')
                ->withErrors($e->errors())
                ->withInput()
                ->with('errorDetails', 'Error en la validación. Por favor, complete todos los campos.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error al actualizar el contrato: ' . $e->getMessage());
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
            ]);
    
            // Creación del contrato
            $contrato = Contrato::create([
                'cliente_id' => $request->cliente_id,
                'fecha_contrato' => $request->fecha,
                'estado_contrato' => $request->estado,
                'observaciones' => $request->observaciones,
            ]);
    
            // Asignación de servicios, planes, categorías y IP
            foreach ($request->servicio_id as $index => $servicio_id) {
                ContratoServicio::create([
                    'contrato_id' => $contrato->id,
                    'servicio_id' => $servicio_id,
                    'plan_id' => $request->plan_id[$index],
                    'categoria_id' => $request->categoria_id[$index],
                    'ip_servicio' => $request->ip_servicio[$index],
                    'fecha_servicio' => now(),
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
