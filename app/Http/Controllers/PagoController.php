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
        try {
            // Obtener el año actual
            $año_actual = now()->year;

            // Obtener todos los años disponibles de la tabla pagos
            $años_disponibles = Pago::selectRaw('DISTINCT YEAR(created_at) as año')
                ->orderByDesc('año')
                ->pluck('año');

            // Asegurarnos que el año actual esté en la lista
            if (!$años_disponibles->contains($año_actual)) {
                $años_disponibles->push($año_actual);
                $años_disponibles = $años_disponibles->sort()->reverse();
            }

            // Si no hay años disponibles, usar solo el año actual
            if ($años_disponibles->isEmpty()) {
                $años_disponibles = collect([$año_actual]);
            }

            // Obtener el año seleccionado del selector
            $año_seleccionado = $request->get('año', $años_disponibles->first());

            // Obtener los pagos del año seleccionado
            $pagos = Pago::whereYear('created_at', $año_seleccionado)
                ->orderByDesc('created_at')
                ->paginate(10);

            // Agregar el año a la URL de paginación
            $pagos->appends(['año' => $año_seleccionado]);

            return view('panel.historial-pago', [
                'pagos' => $pagos,
                'años_disponibles' => $años_disponibles,
                'año_seleccionado' => $año_seleccionado
            ]);

        } catch (\Exception $e) {

            return view('panel.historial-pago', [
                'pagos' => collect([]),
                'años_disponibles' => collect([now()->year]),
                'año_seleccionado' => now()->year
            ]);
        }
    }

    public function eliminarPago($id)
    {
        try {
            $pago = Pago::where('cliente_id', Auth::id())
                ->where('id', $id)
                ->where('estado', 'en_revision')
                ->firstOrFail();

            // Eliminar el comprobante si existe
            if ($pago->comprobante_path) {
                // Log para debug
                Log::info('Intentando eliminar comprobante: ' . $pago->comprobante_path);
                
                // Eliminar el archivo
                if (Storage::disk('public')->exists($pago->comprobante_path)) {
                    Storage::disk('public')->delete($pago->comprobante_path);
                    Log::info('Comprobante eliminado correctamente');
                } else {
                    Log::warning('Comprobante no encontrado en storage: ' . $pago->comprobante_path);
                }
            }

            // Eliminar el registro de pago
            $pago->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pago y comprobante eliminados correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error al eliminar pago: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el pago: ' . $e->getMessage()
            ], 400);
        }
    }
} 