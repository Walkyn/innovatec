<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoServicio extends Model
{
    use HasFactory;

    protected $table = 'contrato_servicio';

    protected $fillable = [
        'contrato_id',
        'servicio_id',
        'plan_id',
        'categoria_id',
        'ip_servicio',
        'fecha_servicio',
        'estado_servicio_cliente',
        'fecha_suspension_servicio',
    ];

    protected $casts = [
        'fecha_servicio' => 'datetime',
        'fecha_suspension_servicio' => 'date',
    ];

    public function meses()
    {
        return $this->hasMany(Mes::class, 'contrato_servicio_id');
    }

    /**
     * Relación con el contrato.
     */
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    /**
     * Relación con el servicio.
     */
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    /**
     * Relación con el plan.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}
