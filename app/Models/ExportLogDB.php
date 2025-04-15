<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportLogDB extends Model
{
    protected $table = 'export_logs_db';
    
    protected $fillable = ['type'];

    public static function ultimaExportacion($type = 'database')
    {
        return static::where('type', $type)
                    ->latest()
                    ->first();
    }
} 