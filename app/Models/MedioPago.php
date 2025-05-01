<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    use HasFactory;

    protected $table = 'medios_pago';

    protected $fillable = [
        'tipo_pago',
        'numero_cuenta',
        'titular'
    ];
} 