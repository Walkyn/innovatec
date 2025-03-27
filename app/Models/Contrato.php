<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos';

    protected $fillable = [
        'cliente_id',
        'observaciones',
        'fecha_contrato',
        'estado_contrato',
    ];

    protected $casts = [
        'fecha_contrato' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'contrato_servicio')
            ->withPivot(['plan_id', 'estado_servicio_cliente', 'fecha_servicio', 'updated_at'])
            ->with('planes');
    }

    public function totalServicios()
    {
        return $this->hasMany(ContratoServicio::class, 'contrato_id')->count();
    }

    public function totalPago()
    {
        return $this->hasMany(ContratoServicio::class, 'contrato_id')
            ->join('planes', 'contrato_servicio.plan_id', '=', 'planes.id')
            ->sum('planes.precio');
    }

    public function contratoServicios()
    {
        return $this->hasMany(ContratoServicio::class);
    }

    /**
     * Obtener el precio de un servicio específico.
     */
    public function obtenerPrecioServicio($servicioId)
    {
        $servicio = $this->servicios()->where('servicio_id', $servicioId)->first();
        return $servicio ? $servicio->pivot->precio : null;
    }

    /**
     * Obtener el nombre de un servicio específico.
     */
    public function obtenerNombreServicio($servicioId)
    {
        $servicio = $this->servicios()->where('servicio_id', $servicioId)->first();
        return $servicio ? $servicio->nombre : null;
    }

    /**
     * Obtener el estado del contrato.
     */
    public function obtenerEstado()
    {
        return $this->estado_contrato;
    }
}
