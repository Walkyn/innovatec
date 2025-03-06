<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_archivo',
        'ubicacion',
        'fecha',
        'descripcion',
    ];

    public function getLinkAttribute()
    {
        return 'Ruta local: ' . $this->ubicacion;
    }
}
