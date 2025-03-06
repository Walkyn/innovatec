<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobranza extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'monto_pago_efectivo',
        'monto_cambio_efectivo',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class);
    }
}