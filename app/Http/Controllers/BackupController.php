<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DatabaseBackup;

class BackupController extends Controller
{
    public function backupDatabase()
    {
        try {
            // Obtener las credenciales de la base de datos
            $host = config('database.connections.mysql.host');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $database = config('database.connections.mysql.database');

            // Crear nombre del archivo
            $filename = "backup-" . Carbon::now()->format('Y-m-d-H-i-s') . ".sql";
            $path = storage_path('app/backups/' . $filename);

            // Asegurarse de que el directorio existe
            if (!Storage::exists('backups')) {
                Storage::makeDirectory('backups');
            }

            // Comando para crear el backup
            $command = sprintf(
                'mysqldump -h %s -u %s -p%s %s > %s',
                escapeshellarg($host),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database),
                escapeshellarg($path)
            );

            // Ejecutar el comando
            exec($command);

            // Verificar si el archivo se creó
            if (file_exists($path)) {
                // Obtener el tamaño real del archivo
                clearstatcache(true, $path);
                $tamanioBytes = filesize($path);
                $tamanioMB = $tamanioBytes > 0 ? round($tamanioBytes / 1048576, 2) : 0;

                // Registrar en la base de datos
                DatabaseBackup::create([
                    'nombre' => $filename,
                    'tamanio' => $tamanioMB . ' MB',
                    'estado' => 'Completado',
                    'archivo_path' => 'backups/' . $filename
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Backup creado exitosamente'
                ]);
            }

            throw new \Exception('No se pudo crear el archivo de backup');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el backup: ' . $e->getMessage()
            ], 500);
        }
    }
} 