<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'assigned_to',
        'status',
    ];

    public function contratoServicio()
    {
        return $this->hasOne(\App\Models\ContratoServicio::class, 'ip_servicio', 'ip_address');
    }
} 