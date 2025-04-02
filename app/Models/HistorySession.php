<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorySession extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'device',
        'browser',
        'platform',
        'location',
        'login_successful',
        'login_at',
        'logout_at'
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
        'login_successful' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 