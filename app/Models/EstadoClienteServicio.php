<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoClienteServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 
        'servicio_id', 
        'estado_servicio', 
        'fecha_inicio_estado', 
        'fecha_fin_estado'
    ];

    /**
     * Relación con el modelo Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación con el modelo Servicio.
     */
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
