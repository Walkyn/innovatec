<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Region;
use App\Models\Pueblo;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Cliente::withCount('contratos')->paginate(8);
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
}
