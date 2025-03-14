<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('servicios')->get();
        $servicios = Servicio::with('categoria')->paginate(7);
        $user = Auth::user();

        return view('services.index', compact('servicios', 'categorias', 'user'));
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'servicio_id' => 'required|exists:servicios,id',
        ]);

        $existePlan = Plan::where('nombre', $request->nombre)
            ->where('servicio_id', $request->servicio_id)
            ->exists();

        if ($existePlan) {
            return redirect()->back()->with([
                'errorMessage' => 'Error',
                'errorDetails' => 'El plan ya existe para este servicio.',
            ])->withInput();
        }

        Plan::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'servicio_id' => $request->servicio_id,
        ]);

        return redirect()->route('services.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'Plan registrado exitosamente.',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255',
            'servicio' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $categoria = Categoria::firstOrCreate(['nombre' => $request->categoria]);

        $servicioExistente = Servicio::where('nombre', $request->servicio)
            ->where('categoria_id', $categoria->id)
            ->first();

        if ($servicioExistente) {
            return redirect()->route('services.index')->with([
                'errorMessage' => 'Advertencia',
                'errorDetails' => 'El servicio ingresado ya está registrado en esta categoría.'
            ]);
        }

        // Crear el servicio
        Servicio::create([
            'nombre' => $request->servicio,
            'descripcion' => $request->descripcion ?? '',
            'estado' => $request->estado,
            'categoria_id' => $categoria->id,
        ]);

        return redirect()->route('services.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'Servicio registrado exitosamente.'
        ]);
    }



    public function destroy(Servicio $servicio)
    {
        $servicio->estado_servicio = 'eliminado';
        $servicio->save();

        return redirect()->route('services.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'El servicio ha sido dado de baja exitosamente.',
        ]);
    }
}
