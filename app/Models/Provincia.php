<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
}
