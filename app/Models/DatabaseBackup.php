<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatabaseBackup extends Model
{
    protected $table = 'database_backups';
    
    protected $fillable = [
        'nombre',
        'tamanio',
        'estado',
        'archivo_path'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public static function ultimoBackup()
    {
        return static::latest()->first();
    }
} 