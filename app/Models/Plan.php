<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes';
    protected $fillable = ['nombre', 'precio', 'servicio_id'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function contratoServicio()
    {
        return $this->hasMany(ContratoServicio::class);
    }
}
