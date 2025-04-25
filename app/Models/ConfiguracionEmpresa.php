<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfiguracionEmpresa extends Model
{
    use HasFactory;

    protected $table = 'configuracion_empresa';
    protected $fillable = [
        'nombre', 
        'ruc', 
        'direccion', 
        'telefono', 
        'correo', 
        'descripcion',
        'logo',
        'portada',
        'facebook',
        'whatsapp',
        'linkedin',
        'website',
    ];
}
