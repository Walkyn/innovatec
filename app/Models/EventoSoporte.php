<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventoSoporte extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'eventos_soporte';

    protected $fillable = [
        'titulo',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'cliente_id',
        'tecnico_id',
        'todo_dia'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'todo_dia' => 'boolean'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}
