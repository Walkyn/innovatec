<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobranza extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'monto_total',
        'monto_pago_efectivo',
        'monto_cambio_efectivo',
        'tipo_pago',
        'fecha_cobro',
        'estado_cobro',
        'glosa',
        'numero_boleta'
    ];

    protected $casts = [
        'fecha_cobro' => 'date',
        'monto_total' => 'decimal:2',
        'monto_pago_efectivo' => 'decimal:2',
        'monto_cambio_efectivo' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cobranza) {
            $year = date('Y');
            $ultimaBoleta = static::where('numero_boleta', 'like', $year . '-%')
                                ->orderBy('numero_boleta', 'desc')
                                ->first();

            if ($ultimaBoleta) {
                $ultimoNumero = intval(substr($ultimaBoleta->numero_boleta, 5));
                $siguienteNumero = $ultimoNumero + 1;
            } else {
                $siguienteNumero = 1;
            }

            $cobranza->numero_boleta = $year . '-' . str_pad($siguienteNumero, 6, '0', STR_PAD_LEFT);
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cobranzaContratoServicios()
    {
        return $this->hasMany(CobranzaContratoServicio::class);
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