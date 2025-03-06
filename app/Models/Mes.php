<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'numero',
        'anio',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $table = 'meses';

    public function cobranzas()
    {
        return $this->hasMany(Cobranza::class);
    }
    public function contratoServicio()
    {
        return $this->belongsTo(ContratoServicio::class, 'contrato_servicio_id'); // Ajusta la clave foránea si es necesario
    }
}
