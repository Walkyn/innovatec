<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ExportLogExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsExport;
use App\Models\DatabaseBackup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DatabaseController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $backups = DatabaseBackup::orderBy('created_at', 'desc')->paginate(10);

        return view('database.index', compact('backups'));
    }

    public function exportarClientes()
    {
        $fecha = now()->format('d-m-Y');

        ExportLogExcel::create([
            'type' => 'excel'
        ]);

        event(new \Illuminate\Support\Facades\Event([
            'fecha' => now()
        ]));

        return Excel::download(new ClientsExport, "CLIENTES_EXPORT_{$fecha}.xlsx");
    }

    public function descargar($id)
    {
        try {
            $backup = DatabaseBackup::findOrFail($id);
            $path = storage_path('app/' . $backup->archivo_path);

            if (!file_exists($path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'El archivo de respaldo no se encuentra en el servidor'
                ], 404);
            }

            return response()->download($path, $backup->nombre);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al descargar el backup: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Buscar el backup
            $backup = DatabaseBackup::findOrFail($id);

            // Obtener la ruta completa del archivo
            $filePath = storage_path('app/' . $backup->archivo_path);

            // Verificar si el archivo existe y eliminarlo usando unlink
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            if (Storage::exists($backup->archivo_path)) {
                Storage::delete($backup->archivo_path);
            }

            $backup->delete();

            return response()->json([
                'success' => true,
                'message' => 'Backup eliminado correctamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el backup: ' . $e->getMessage()
            ], 500);
        }
    }
}
