<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    protected $fillable = [
        'tipo',
        'registros_importados',
        'registros_fallidos',
        'archivo_nombre'
    ];

    public static function registrarImportacion($tipo, $registrosImportados, $registrosFallidos = 0, $archivoNombre = null)
    {
        return self::create([
            'tipo' => $tipo,
            'registros_importados' => $registrosImportados,
            'registros_fallidos' => $registrosFallidos,
            'archivo_nombre' => $archivoNombre
        ]);
    }

    public static function ultimaImportacion($tipo)
    {
        return self::where('tipo', $tipo)
                   ->latest()
                   ->first();
    }
} 