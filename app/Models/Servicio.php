<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = ['nombre', 'descripcion', 'estado_servicio', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function contratoServicios()
    {
        return $this->hasMany(ContratoServicio::class, 'servicio_id');
    }    

    public function planes()
    {
        return $this->hasMany(Plan::class);
    }    

    public function estadoServicios()
    {
        return $this->hasMany(EstadoClienteServicio::class);
    }

    public function contratos()
    {
        return $this->belongsToMany(Contrato::class, 'contrato_servicio')
            ->withPivot('fecha_servicio','plan_id')
            ->withTimestamps();
    }
    
}
