<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitchToken extends Model
{
    protected $fillable = [
        'access_token',
        'invalidated',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'invalidated' => 'boolean',
        ];
    }
}
