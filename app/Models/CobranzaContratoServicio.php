<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobranzaContratoServicio extends Model
{
    use HasFactory;

    protected $table = 'crobranza_contratoservicio';

    protected $fillable = [
        'cobranza_id',
        'mes_id',
        'cobranza_contratoservicio_id',
        'monto_pagado'
    ];
}
