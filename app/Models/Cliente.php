<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion',
        'direccion',
        'telefono',
        'gps',
        'region_id',
        'provincia_id',
        'distrito_id',
        'pueblo_id',
        'estado_cliente',
        'created_at',
        'updated_at'
    ];

    public function contratos()
    {
        return $this->hasMany(Contrato::class);
    }

    public function totalServicios()
    {
        return $this->hasManyThrough(
            ContratoServicio::class,
            Contrato::class,
            'cliente_id',
            'contrato_id',
            'id',
            'id'
        )->count();
    }

    public function cobranzas()
    {
        return $this->hasMany(Cobranza::class);
    }

    public function meses()
    {
        return $this->hasManyThrough(Mes::class, Cobranza::class, 'cliente_id', 'id', 'id', 'mes_id');
    }

    public function estadoServicios()
    {
        return $this->hasMany(EstadoClienteServicio::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function distrito(): BelongsTo
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }

    public function pueblo(): BelongsTo
    {
        return $this->belongsTo(Pueblo::class, 'pueblo_id');
    }
}
