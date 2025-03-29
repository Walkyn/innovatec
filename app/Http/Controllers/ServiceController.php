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

    // Métodos para Planes
    public function getPlanes(Servicio $servicio)
    {
        return response()->json($servicio->planes);
    }

    public function editPlan($id)
    {
        $plan = Plan::findOrFail($id);
        return response()->json($plan);
    }

    public function updatePlan(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Plan actualizado correctamente.',
        ]);
    }

    public function destroyPlan($id)
    {
        try {
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Plan eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el plan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getServiciosByCategoria($id)
    {
        $categoria = Categoria::with('servicios')->findOrFail($id);
        return response()->json($categoria->servicios);
    }

    public function editServicio($id)
    {
        $servicio = Servicio::findOrFail($id);
        return response()->json($servicio);
    }

    public function updateServicio(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Servicio actualizado correctamente.',
        ]);
    }

    public function destroyServices($id)
    {
        try {
            $servicio = Servicio::findOrFail($id);
            $servicio->delete();

            return response()->json([
                'success' => true,
                'message' => 'Servicio eliminado correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el servicio: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editCategory($id)
    {
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $existeCategoria = Categoria::where('nombre', $request->nombre)
            ->where('id', '!=', $id)
            ->exists();

        if ($existeCategoria) {
            return response()->json([
                'success' => false,
                'message' => 'La categoría ya existe.',
            ], 422);
        }

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada correctamente.',
        ]);
    }

    public function destroyCategory($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);

            $categoria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada correctamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $existeCategoria = Categoria::where('nombre', $request->nombre)->exists();

        if ($existeCategoria) {
            return redirect()->back()->with([
                'errorMessage' => 'Error',
                'errorDetails' => 'La categoría ya existe.',
            ])->withInput();
        }

        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('services.index')->with([
            'successMessage' => 'Éxito',
            'successDetails' => 'Categoría creada exitosamente.',
        ]);
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
