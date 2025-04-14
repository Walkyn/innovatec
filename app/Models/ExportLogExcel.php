<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExportLogExcel extends Model
{
    protected $table = 'export_logs_excel';
    protected $fillable = ['type'];

    public static function ultimaExportacion($type = 'excel')
    {
        return static::where('type', $type)
                    ->latest()
                    ->first();
    }
} 