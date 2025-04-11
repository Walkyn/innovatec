<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobranzaContratoServicio extends Model
{
    use HasFactory;

    protected $table = 'cobranza_contratoservicio';

    protected $fillable = [
        'cobranza_id',
        'contrato_servicio_id',
        'mes_id',
        'monto_pagado',
        'estado_pago'
    ];

    protected $casts = [
        'monto_pagado' => 'decimal:2'
    ];

    public function cobranza()
    {
        return $this->belongsTo(Cobranza::class);
    }

    public function contratoServicio()
    {
        return $this->belongsTo(ContratoServicio::class);
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class);
    }
}
