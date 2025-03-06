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
        $clientes = Cliente::all();
        $categorias = Categoria::with('servicios.planes')->get();
        $contratos = Contrato::with(['cliente', 'servicios'])->paginate(7);
    
        foreach ($contratos as $contrato) {
            $contrato->detalles_servicios = $contrato->servicios->map(function ($servicio) {
                $plan = $servicio->planes->where('id', $servicio->pivot->plan_id)->first();

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
                ];
            });
        }
    
        return view('contracts.index', compact('clientes', 'categorias', 'contratos'));
    }

    public function obtenerPrecioPlan($contratoId, $servicioId)
    {
        $contrato = Contrato::with(['contratoServicios.plan'])
            ->where('id', $contratoId)
            ->first();

        if (!$contrato) {
            return response()->json(['error' => 'Contrato no encontrado'], 404);
        }

        // Buscar el servicio en el contrato
        $contratoServicio = $contrato->contratoServicios->where('servicio_id', $servicioId)->first();

        if (!$contratoServicio) {
            return response()->json(['error' => 'Servicio no encontrado en el contrato'], 404);
        }

        // Obtener el precio del plan asociado
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
            ]);

            // Creación del contrato
            $contrato = Contrato::create([
                'cliente_id' => $request->cliente_id,
                'fecha_contrato' => $request->fecha,
                'estado_contrato' => $request->estado,
            ]);

            // Asignación de servicios, planes y categorías
            foreach ($request->servicio_id as $index => $servicio_id) {
                ContratoServicio::create([
                    'contrato_id' => $contrato->id,
                    'servicio_id' => $servicio_id,
                    'plan_id' => $request->plan_id[$index],
                    'categoria_id' => $request->categoria_id[$index],
                    'fecha_servicio' => now(),
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
                ->with('errorDetails', 'Error en la validación. Por favor, complete todo los campos.');
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
