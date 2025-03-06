<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulos';
    protected $primaryKey = 'id_modulo';
    protected $fillable = ['nombre_modulo'];

    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'id_modulo');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_modulo', 'id_modulo', 'id_usuario');
    }
}
