<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pueblo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'distrito_id'];

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
}
