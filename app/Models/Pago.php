<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 
        'medio_pago', 
        'detalles_servicio', 
        'meses_pagados', 
        'monto_total',
        'comprobante_path',
        'estado',
        'observaciones'
    ];
    
    /**
     * Estados posibles del pago
     */
    const ESTADO_EN_REVISION = 'en_revision';
    const ESTADO_APROBADO = 'Aprobado';
    const ESTADO_RECHAZADO = 'Rechazado';

    /**
     * Obtiene el cliente asociado al pago.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
    /**
     * Obtiene nombre legible del estado
     */
    public function getNombreEstadoAttribute()
    {
        switch($this->estado) {
            case self::ESTADO_EN_REVISION:
                return 'En revisión';
            case self::ESTADO_APROBADO:
                return 'Aprobado';
            case self::ESTADO_RECHAZADO:
                return 'Rechazado';
            default:
                return ucfirst(str_replace('_', ' ', $this->estado));
        }
    }
} 