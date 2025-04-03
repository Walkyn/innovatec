<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Region;
use App\Models\Pueblo;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::withCount('contratos');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombres', 'like', "%{$searchTerm}%")
                  ->orWhere('apellidos', 'like', "%{$searchTerm}%")
                  ->orWhere('identificacion', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado_cliente', $request->estado);
        }

        $clientes = $query->paginate(8);
        $regiones = Region::with('provincias.distritos.pueblos')->get();
        return view('clients.index', compact('clientes', 'regiones'));
    }

    public function create()
    {
        $regiones = Region::with('provincias.distritos.pueblos')->get();
        return view('clients.create', compact('regiones'));
    }

    public function edit($id)
    {
        $cliente = Cliente::with(['region', 'provincia', 'distrito', 'pueblo'])->findOrFail($id);
        $regiones = Region::with('provincias.distritos.pueblos')->get();
        return view('clients.edit', compact('cliente', 'regiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:clientes,identificacion',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'gps' => 'nullable|string|max:255',
            'region_id' => 'nullable|exists:regiones,id',
            'provincia_id' => 'nullable|exists:provincias,id',
            'distrito_id' => 'nullable|exists:distritos,id',
            'pueblo' => 'nullable|string|max:255',
            'estado_cliente' => 'required|in:activo,inactivo,suspendido'
        ], [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string' => 'El campo nombres debe ser una cadena de texto.',
            'nombres.max' => 'El campo nombres no puede tener más de 255 caracteres.',

            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser una cadena de texto.',
            'apellidos.max' => 'El campo apellidos no puede tener más de 255 caracteres.',

            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.string' => 'El campo identificación debe ser una cadena de texto.',
            'identificacion.max' => 'El campo identificación no puede tener más de 255 caracteres.',
            'identificacion.unique' => 'La identificación ya está registrada en el sistema.',

            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no puede tener más de 15 caracteres.',

            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no puede tener más de 255 caracteres.',

            'gps.string' => 'El campo GPS debe ser una cadena de texto.',
            'gps.max' => 'El campo GPS no puede tener más de 255 caracteres.',

            'region_id.exists' => 'La región seleccionada no es válida.',
            'provincia_id.exists' => 'La provincia seleccionada no es válida.',
            'distrito_id.exists' => 'El distrito seleccionado no es válido.',

            'pueblo.string' => 'El campo pueblo debe ser una cadena de texto.',
            'pueblo.max' => 'El campo pueblo no puede tener más de 255 caracteres.',

            'estado_cliente.required' => 'El estado del cliente es obligatorio.',
            'estado_cliente.in' => 'El estado seleccionado no es válido. Debe ser Activo, Inactivo o Suspendido.',
        ]);

        try {
            DB::beginTransaction();

            $puebloId = null;

            if (!empty($request->pueblo)) {
                $puebloNombre = strtoupper(trim($request->pueblo));

                $pueblo = Pueblo::where('nombre', $puebloNombre)
                    ->where('distrito_id', $request->distrito_id)
                    ->first();

                if ($pueblo) {
                    $puebloId = $pueblo->id;
                } else {
                    $nuevoPueblo = Pueblo::create([
                        'nombre' => $puebloNombre,
                        'distrito_id' => $request->distrito_id,
                    ]);
                    $puebloId = $nuevoPueblo->id;
                }
            }

            Cliente::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'identificacion' => $request->identificacion,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'gps' => $request->gps,
                'region_id' => $request->region_id,
                'provincia_id' => $request->provincia_id,
                'distrito_id' => $request->distrito_id,
                'pueblo_id' => $puebloId,
                'estado_cliente' => $request->estado_cliente
            ]);

            DB::commit();

            return redirect()->route('clients.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Cliente registrado con éxito'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clients.create')
                ->withInput()
                ->with('errorDetails', 'Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:clientes,identificacion,' . $id,
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'gps' => 'nullable|string|max:255',
            'region_id' => 'nullable|exists:regiones,id',
            'provincia_id' => 'nullable|exists:provincias,id',
            'distrito_id' => 'nullable|exists:distritos,id',
            'pueblo' => 'nullable|string|max:255',
            'estado_cliente' => 'required|in:activo,inactivo,suspendido'
        ], [
            'nombres.required' => 'El campo nombres es obligatorio.',
            'nombres.string' => 'El campo nombres debe ser una cadena de texto.',
            'nombres.max' => 'El campo nombres no puede tener más de 255 caracteres.',

            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser una cadena de texto.',
            'apellidos.max' => 'El campo apellidos no puede tener más de 255 caracteres.',

            'identificacion.required' => 'El campo identificación es obligatorio.',
            'identificacion.string' => 'El campo identificación debe ser una cadena de texto.',
            'identificacion.max' => 'El campo identificación no puede tener más de 255 caracteres.',
            'identificacion.unique' => 'La identificación ya está registrada en el sistema.',

            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no puede tener más de 15 caracteres.',

            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no puede tener más de 255 caracteres.',

            'gps.string' => 'El campo GPS debe ser una cadena de texto.',
            'gps.max' => 'El campo GPS no puede tener más de 255 caracteres.',

            'region_id.exists' => 'La región seleccionada no es válida.',
            'provincia_id.exists' => 'La provincia seleccionada no es válida.',
            'distrito_id.exists' => 'El distrito seleccionado no es válido.',

            'pueblo.string' => 'El campo pueblo debe ser una cadena de texto.',
            'pueblo.max' => 'El campo pueblo no puede tener más de 255 caracteres.',

            'estado_cliente.required' => 'El estado del cliente es obligatorio.',
            'estado_cliente.in' => 'El estado seleccionado no es válido. Debe ser Activo, Inactivo o Suspendido.',
        ]);

        try {
            DB::beginTransaction();

            $cliente = Cliente::findOrFail($id);

            $puebloId = null;

            if (!empty($request->pueblo)) {
                $puebloNombre = strtoupper(trim($request->pueblo));

                $pueblo = Pueblo::where('nombre', $puebloNombre)
                    ->where('distrito_id', $request->distrito_id)
                    ->first();

                if ($pueblo) {
                    $puebloId = $pueblo->id;
                } else {
                    $nuevoPueblo = Pueblo::create([
                        'nombre' => $puebloNombre,
                        'distrito_id' => $request->distrito_id,
                    ]);
                    $puebloId = $nuevoPueblo->id;
                }
            }

            $cliente->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'identificacion' => $request->identificacion,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'gps' => $request->gps,
                'region_id' => $request->region_id,
                'provincia_id' => $request->provincia_id,
                'distrito_id' => $request->distrito_id,
                'pueblo_id' => $puebloId,
                'estado_cliente' => $request->estado_cliente
            ]);

            DB::commit();

            return redirect()->route('clients.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Cliente actualizado con éxito'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clients.edit', $id)
                ->withInput()
                ->with('errorDetails', 'Error: ' . $e->getMessage());
        }
    }

    public function assignService()
    {
        return view('clients.assign_service');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $cliente = Cliente::findOrFail($id);

            $cliente->contratos()->each(function ($contrato) {
                $contrato->contratoServicios()->delete();
                $contrato->delete();
            });

            $cliente->delete();

            DB::commit();

            return redirect()->route('clients.index')->with([
                'successMessage' => 'Éxito',
                'successDetails' => 'Cliente eliminado con éxito'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('clients.index')->with([
                'errorDetails' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function getDetails($id)
    {
        try {
            $cliente = Cliente::with(['region', 'provincia', 'distrito', 'pueblo', 'contratos' => function($query) {
                $query->where('estado_contrato', 'activo');
            }])->findOrFail($id);

            $contratoActivo = $cliente->contratos->first();
            $servicioActivo = null;
            $planActivo = null;

            if ($contratoActivo) {
                $contratoServicio = $contratoActivo->contratoServicios()
                    ->with(['servicio' => function($query) {
                        $query->where('estado_servicio', 'activo');
                    }, 'plan'])
                    ->first();

                if ($contratoServicio && $contratoServicio->servicio) {
                    $servicioActivo = $contratoServicio->servicio;
                    $planActivo = $contratoServicio->plan;
                }
            }

            return response()->json([
                'success' => true,
                'cliente' => [
                    'id' => $cliente->id,
                    'nombres' => $cliente->nombres,
                    'apellidos' => $cliente->apellidos,
                    'identificacion' => $cliente->identificacion,
                    'telefono' => $cliente->telefono,
                    'gps' => $cliente->gps,
                    'region' => $cliente->region ? $cliente->region->nombre : null,
                    'provincia' => $cliente->provincia ? $cliente->provincia->nombre : null,
                    'distrito' => $cliente->distrito ? $cliente->distrito->nombre : null,
                    'pueblo' => $cliente->pueblo ? $cliente->pueblo->nombre : null,
                    'direccion' => $cliente->direccion,
                    'estado_cliente' => $cliente->estado_cliente,
                    'created_at' => $cliente->created_at ? date('d/m/Y', strtotime($cliente->created_at)) : null,
                    'contrato_activo' => $contratoActivo ? [
                        'id' => $contratoActivo->id,
                        'numero' => $contratoActivo->numero,
                        'fecha_inicio' => $contratoActivo->fecha_inicio ? date('d/m/Y', strtotime($contratoActivo->fecha_inicio)) : null,
                        'fecha_instalacion' => $cliente->created_at ? date('d/m/Y', strtotime($cliente->created_at)) : null
                    ] : null,
                    'servicio_activo' => $servicioActivo ? [
                        'id' => $servicioActivo->id,
                        'nombre' => $servicioActivo->nombre,
                        'descripcion' => $servicioActivo->descripcion
                    ] : null,
                    'plan_activo' => $planActivo ? [
                        'id' => $planActivo->id,
                        'nombre' => $planActivo->nombre,
                        'precio' => $planActivo->precio
                    ] : null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errorDetails' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
