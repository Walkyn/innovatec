<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DatabaseBackup;
use Illuminate\Support\Facades\Log;
use App\Models\ExportLogDB;

class BackupController extends Controller
{
    private function getMysqlDumpPath()
    {
        if (PHP_OS === 'WINNT') {
            // Rutas comunes en Windows
            $possiblePaths = [
                'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe',
                'C:\xampp\mysql\bin\mysqldump.exe',
                'C:\wamp64\bin\mysql\mysql8.0.31\bin\mysqldump.exe'
            ];

            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    return '"' . $path . '"';
                }
            }

            throw new \Exception('No se encontró mysqldump en las rutas comunes de Windows');
        }

        // En Linux/Unix
        return 'mysqldump';
    }

    /**
     * Realiza el backup de la base de datos
     */
    public function backupDatabase()
    {
        try {
            // Verificar configuración y permisos
            $this->verificarConfiguracion();

            // Obtener credenciales de la base de datos
            $host = config('database.connections.mysql.host');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $database = config('database.connections.mysql.database');
            $filename = "backup-" . Carbon::now()->format('Y-m-d-H-i-s') . ".sql";
            $path = storage_path('app/backups/' . $filename);

            // Asegurar que el directorio de backups existe
            if (!Storage::exists('backups')) {
                Storage::makeDirectory('backups');
            }

            // Obtener ruta de mysqldump
            $mysqldump = $this->getMysqlDumpPath();

            // Construir el comando
            $command = sprintf(
                '%s --user="%s" --password="%s" --host="%s" --databases %s --add-drop-database --add-drop-table --default-character-set=utf8mb4 --skip-comments > "%s"',
                $mysqldump,
                $username,
                $password,
                $host,
                $database,
                $path
            );

            // Ejecutar el comando
            $output = [];
            $returnVar = 0;
            exec($command . ' 2>&1', $output, $returnVar);

            // Verificar si hubo errores en la ejecución
            if ($returnVar !== 0) {
                throw new \Exception('Error al ejecutar mysqldump: ' . implode("\n", $output));
            }

            // Verificar el archivo resultante
            if (!file_exists($path) || filesize($path) === 0) {
                throw new \Exception('El archivo de backup está vacío o no se creó correctamente');
            }

            // Calcular tamaño del archivo
            clearstatcache(true, $path);
            $tamanioBytes = filesize($path);
            $tamanioMB = round($tamanioBytes / 1048576, 2);

            // Registrar el backup en la base de datos
            DatabaseBackup::create([
                'nombre' => $filename,
                'tamanio' => $tamanioMB . ' MB',
                'estado' => 'Completado',
                'archivo_path' => 'backups/' . $filename
            ]);

            // Después de crear el backup exitosamente
            ExportLogDB::create([
                'type' => 'database'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Backup creado exitosamente',
                'data' => [
                    'filename' => $filename,
                    'size' => $tamanioMB . ' MB'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error en backup de base de datos: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al crear el backup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verifica la configuración necesaria para realizar backups
     */
    private function verificarConfiguracion()
    {
        // Verificar conexión a la base de datos
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            throw new \Exception("No se puede conectar a la base de datos: " . $e->getMessage());
        }

        // Verificar permisos de escritura en el directorio de backups
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            if (!mkdir($backupPath, 0755, true)) {
                throw new \Exception("No se pudo crear el directorio de backups");
            }
        }

        if (!is_writable($backupPath)) {
            throw new \Exception("El directorio de backups no tiene permisos de escritura: " . $backupPath);
        }

        return true;
    }
}
