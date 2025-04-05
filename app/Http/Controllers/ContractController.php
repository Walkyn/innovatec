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
            $contrato->detalles_servicios = $contrato->servicios->map(function ($servicio) use ($contrato) {
                $plan = $servicio->planes->where('id', $servicio->pivot->plan_id)->first();
                $contratoServicio = $contrato->contratoServicios->where('servicio_id', $servicio->id)->first();

                $fechaServicio = $servicio->pivot->fecha_servicio
                    ? \Carbon\Carbon::parse($servicio->pivot->fecha_servicio)->format("d/m/Y")
                    : 'N/A';

                $mesServicio = $servicio->pivot->fecha_servicio
                    ? \Carbon\Carbon::parse($servicio->pivot->fecha_servicio)->locale('es')->isoFormat('MMMM')
                    : 'N/A';
    
                return [
                    'id' => $servicio->id,
                    'nombre' => $servicio->nombre,
                    'fecha' => $fechaServicio,
                    'estado' => $servicio->pivot->estado_servicio_cliente ?? 'Desconocido',
                    'mes' => $mesServicio,
                    'plan' => optional($plan)->nombre ?? 'N/A',
                    'precio' => optional($plan)->precio ?? 0,
                    'ip_servicio' => $contratoServicio->ip_servicio ?? null
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
    
            // Actualización del contrato
            $contrato = Contrato::findOrFail($id);
            $contrato->update([
                'cliente_id' => $request->cliente_id,
                'fecha_contrato' => $request->fecha,
                'estado_contrato' => $request->estado,
                'observaciones' => $request->observaciones,
            ]);
    
            // Eliminar servicios antiguos
            $contrato->contratoServicios()->delete();
    
            // Asignación de nuevos servicios, planes, categorías y IP
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
