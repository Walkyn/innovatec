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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function restore(Request $request)
    {
        \Log::info('Iniciando proceso de restauración');
        
        try {
            // Validación básica
            $request->validate([
                'host' => 'required|string',
                'port' => 'required|numeric',
                'database' => 'required|string',
                'username' => 'required|string',
                'password' => 'nullable|string',
                'backup_file' => 'required|file'
            ]);

            if (!$request->hasFile('backup_file')) {
                throw new \Exception('No se ha seleccionado ningún archivo');
            }

            $file = $request->file('backup_file');
            
            // Validar el contenido del archivo
            $content = file_get_contents($file->getRealPath());
            if (!preg_match('/(CREATE|INSERT|UPDATE|DELETE|DROP|ALTER|SELECT)/i', $content)) {
                throw new \Exception('El archivo no parece ser un archivo SQL válido');
            }

            // Verificar la conexión a la base de datos antes de continuar
            try {
                $testConnection = new \PDO(
                    "mysql:host={$request->host};port={$request->port}",
                    $request->username,
                    $request->password
                );
            } catch (\PDOException $e) {
                switch ($e->getCode()) {
                    case 1045:
                        throw new \Exception('Acceso denegado: Usuario o contraseña incorrectos');
                    case 2002:
                        throw new \Exception('No se puede conectar al servidor de base de datos');
                    default:
                        throw new \Exception('Error de conexión: ' . $e->getMessage());
                }
            }

            // Verificar si la base de datos existe
            $databases = $testConnection->query('SHOW DATABASES')->fetchAll(\PDO::FETCH_COLUMN);
            if (!in_array($request->database, $databases)) {
                throw new \Exception('La base de datos especificada no existe');
            }

            // Continuar con el proceso de restauración
            $backupPath = $file->store('temp');
            $fullPath = Storage::path($backupPath);
            
            // Limpiar el contenido del archivo
            $content = preg_replace('/^mysqldump: \[Warning\].*$/m', '', $content);
            $content = preg_replace('/^Warning:.*$/m', '', $content);
            $content = preg_replace('/^\s*\n/m', '', $content);
            
            $cleanFilePath = Storage::path('temp/clean_' . basename($backupPath));
            file_put_contents($cleanFilePath, $content);

            // Ejecutar el comando de restauración
            $command = sprintf(
                'mysql -h %s -P %s -u %s %s %s < %s 2>&1',
                escapeshellarg($request->host),
                escapeshellarg($request->port),
                escapeshellarg($request->username),
                $request->password ? '-p' . escapeshellarg($request->password) : '',
                escapeshellarg($request->database),
                escapeshellarg($cleanFilePath)
            );

            exec($command, $output, $returnVar);

            // Limpiar archivos temporales
            Storage::delete($backupPath);
            @unlink($cleanFilePath);

            if ($returnVar !== 0) {
                throw new \Exception('Error al ejecutar el comando MySQL: ' . implode("\n", $output));
            }

            // Registrar la restauración exitosa
            DB::table('database_restore_logs')->insert([
                'archivo_nombre' => $file->getClientOriginalName(),
                'host' => $request->host,
                'database' => $request->database,
                'username' => $request->username,
                'success' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Base de datos restaurada correctamente',
                'fecha' => now()->format('Y-m-d H:i:s')
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en la restauración: ' . $e->getMessage());
            
            // Registrar el error
            DB::table('database_restore_logs')->insert([
                'archivo_nombre' => $request->file('backup_file')->getClientOriginalName(),
                'host' => $request->host,
                'database' => $request->database,
                'username' => $request->username,
                'success' => false,
                'error_message' => $e->getMessage(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
