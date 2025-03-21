<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = ['nombre'];

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($categoria) {
            $categoria->servicios()->delete();
        });
    }
}
