<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

            // Especificar solo las tablas relacionadas al chat
            $tablasChat = [
                'chats',
                'mensajes',
                'chat_usuarios',
                // Agrega aquí otras tablas relacionadas al chat si existen
            ];

            // Construir el comando solo para las tablas específicas
            $tablas = implode(' ', $tablasChat);
            
            // Comando para crear el backup con --quick y --no-create-info para optimizar
            $command = sprintf(
                'mysqldump -h %s -u %s -p%s --quick --no-create-info %s %s > %s 2>&1 & echo $!',
                escapeshellarg($host),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database),
                escapeshellarg($tablas),
                escapeshellarg($path)
            );

            // Ejecutar el comando en segundo plano
            $pid = exec($command);

            // Verificar si el archivo se está creando
            if (file_exists($path)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Backup iniciado exitosamente',
                    'filename' => $filename
                ]);
            } else {
                throw new \Exception('Error al iniciar el backup');
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el backup: ' . $e->getMessage()
            ], 500);
        }
    }
} 