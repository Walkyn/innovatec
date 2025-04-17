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

    public function index(Request $request)
    {
        try {
            $query = DatabaseBackup::query();
            
            if ($request->has('fecha')) {
                $fecha = $request->fecha;
                $query->whereDate('created_at', $fecha);
            }
            
            $backups = $query->orderBy('created_at', 'desc')->paginate(10);
            
            // Definir las clases de estado
            $estadoClase = [
                'Completado' => 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100',
                'Parcial' => 'text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100',
                'Error' => 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100',
            ];

            $iconoClase = [
                'Completado' => 'fa-check-circle',
                'Parcial' => 'fa-exclamation-circle',
                'Error' => 'fa-times-circle',
            ];
            
            if ($request->ajax()) {
                $view = view('partials.table-content', compact('backups', 'estadoClase', 'iconoClase'))->render();
                return response()->json([
                    'success' => true,
                    'html' => $view,
                    'count' => $backups->total()
                ]);
            }
            
            return view('database.index', compact('backups', 'estadoClase', 'iconoClase'));
        } catch (\Exception $e) {
            Log::error('Error en la búsqueda de backups: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al cargar los datos: ' . $e->getMessage()
                ], 500);
            }
            
            throw $e;
        }
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
            $request->validate([
                'backup_file' => 'required|file',
                'host' => 'required|string',
                'port' => 'required|numeric',
                'database' => 'required|string',
                'username' => 'required|string',
                'password' => 'nullable|string'
            ]);

            if (!$request->hasFile('backup_file')) {
                throw new \Exception('No se ha seleccionado ningún archivo');
            }

            $file = $request->file('backup_file');
            $backupPath = $file->store('temp');
            $fullPath = Storage::path($backupPath);

            // Leer y limpiar el contenido del archivo
            $content = file_get_contents($fullPath);
            
            // Agregar comandos para desactivar y reactivar las restricciones de clave foránea
            $content = "SET FOREIGN_KEY_CHECKS=0;\n" . 
                      $content . 
                      "\nSET FOREIGN_KEY_CHECKS=1;";
            
            // Patrones a eliminar
            $patternsToRemove = [
                '/^mysqldump: \[.*?\]\s.*$/m',
                '/^Warning:.*$/m',
                '/^\/\*.*?\*\/;$/m',
                '/^-- .*$/m',
                '/^\s*\n/m',
                '/^mysqldump: Deprecated.*$/m',
                '/^-- MariaDB dump.*$/m',
                '/^-- Host.*$/m',
                '/^-- Server version.*$/m'
            ];

            // Aplicar limpieza
            foreach ($patternsToRemove as $pattern) {
                $content = preg_replace($pattern, '', $content);
            }

            // Eliminar líneas vacías múltiples
            $content = preg_replace("/[\r\n]+/", "\n", $content);
            $content = trim($content);

            // Guardar archivo limpio
            $cleanFilePath = Storage::path('temp/clean_' . basename($backupPath));
            file_put_contents($cleanFilePath, $content);

            // Detectar entorno
            $isHosting = !in_array(php_uname('s'), ['Windows NT', 'Darwin']);

            // Construir comando con opciones adicionales
            if ($isHosting) {
                $command = sprintf(
                    '/usr/bin/mariadb --init-command="SET SESSION FOREIGN_KEY_CHECKS=0;" -h%s -P%s -u%s%s %s < %s 2>&1',
                    escapeshellarg($request->host),
                    escapeshellarg($request->port),
                    escapeshellarg($request->username),
                    $request->password ? ' -p' . escapeshellarg($request->password) : '',
                    escapeshellarg($request->database),
                    escapeshellarg($cleanFilePath)
                );
            } else {
                $command = sprintf(
                    'mysql --init-command="SET SESSION FOREIGN_KEY_CHECKS=0;" -h%s -P%s -u%s%s %s < %s 2>&1',
                    escapeshellarg($request->host),
                    escapeshellarg($request->port),
                    escapeshellarg($request->username),
                    $request->password ? ' -p' . escapeshellarg($request->password) : '',
                    escapeshellarg($request->database),
                    escapeshellarg($cleanFilePath)
                );
            }

            // Ejecutar comando
            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            // Verificar si hay errores específicos en la salida
            $errorOutput = implode("\n", $output);
            if (strpos($errorOutput, 'ERROR 1451') !== false) {
                throw new \Exception('Error al restaurar: Hay restricciones de clave foránea que impiden la restauración. Por favor, asegúrese de que la base de datos esté vacía o que los datos sean consistentes.');
            }

            if ($returnVar !== 0) {
                throw new \Exception('Error al ejecutar el comando de restauración: ' . $errorOutput);
            }

            // Registrar éxito
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
            
            // Limpiar archivos temporales
            if (isset($backupPath)) {
                Storage::delete($backupPath);
            }
            if (isset($cleanFilePath) && file_exists($cleanFilePath)) {
                @unlink($cleanFilePath);
            }

            // Registrar error
            if ($request->hasFile('backup_file')) {
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
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function truncateDatabase($host, $port, $database, $username, $password, $isHosting)
    {
        try {
            // Obtener todas las tablas
            $pdo = new \PDO(
                "mysql:host={$host};port={$port};dbname={$database}",
                $username,
                $password
            );
            
            // Desactivar restricciones de clave foránea
            $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
            
            // Obtener todas las tablas
            $tables = $pdo->query("SHOW TABLES")->fetchAll(\PDO::FETCH_COLUMN);
            
            // Truncar cada tabla
            foreach ($tables as $table) {
                $pdo->exec("TRUNCATE TABLE `{$table}`");
            }
            
            // Reactivar restricciones
            $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Error al vaciar la base de datos: ' . $e->getMessage());
            return false;
        }
    }
}
