<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTicket extends Model
{
    use HasFactory;

    protected $table = 'info_ticket';

    protected $fillable = [
        'nombre_empresa',
        'eslogan_empresa',
        'ruc',
        'telefono',
        'direccion',
        'agradecimiento',
        'sitio_web',
    ];
}
