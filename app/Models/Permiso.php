<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['id_usuario', 'id_modulo', 'eliminar', 'actualizar', 'guardar'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'id_modulo');
    }
}