<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    public function historial(Request $request)
    {
        // Obtener el ID del cliente desde la sesión personalizada
        $cliente_id = session('cliente_id');
        
        if (!$cliente_id) {
            return redirect()->route('login-cliente')
                ->with('errorDetails', 'Debe iniciar sesión para ver su historial de pagos');
        }

        // Obtener el año seleccionado o el actual
        $año_seleccionado = $request->input('año', date('Y'));

        // Obtener los pagos del usuario filtrados por año
        $pagos = \App\Models\Pago::where('cliente_id', $cliente_id)
            ->whereYear('created_at', $año_seleccionado)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $años_disponibles = \App\Models\Pago::where('cliente_id', $cliente_id)
            ->selectRaw('YEAR(created_at) as año')
            ->distinct()
            ->pluck('año')
            ->toArray();

        // Si no hay años disponibles, agrega el año actual para evitar error en el select
        if (empty($años_disponibles)) {
            $años_disponibles = [date('Y')];
        }

        return view('panel.historial-pago', compact('pagos', 'años_disponibles', 'año_seleccionado'));
    }

    public function eliminarPago($id)
    {
        try {
            // Obtener el ID del cliente desde la sesión personalizada
            $cliente_id = session('cliente_id');
            
            if (!$cliente_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo eliminar el pago: Sesión no iniciada'
                ], 401);
            }

            // Buscar el pago que pertenezca al cliente actual y tenga el ID especificado
            $pago = \App\Models\Pago::where('id', $id)
                                   ->where('cliente_id', $cliente_id)
                                   ->where('estado', 'en_revision')  // Solo permitir eliminar pagos en revisión
                                   ->firstOrFail();
            
            // Eliminar el pago
            $pago->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pago eliminado correctamente'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el pago: Pago no encontrado o no autorizado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el pago: ' . $e->getMessage()
            ], 500);
        }
    }
} 