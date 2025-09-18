<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class HelloassoToken extends Model
{
    protected $fillable = [
        'access_token',
        'refresh_token',
        'invalidated',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'invalidated' => 'boolean',
            'expires_at' => 'datetime',
        ];
    }

    protected function accessToken()
    {
        return Attribute::make(
            get: fn($value) => Crypt::decryptString($value),
            set: fn($value) => Crypt::encryptString($value),
        );
    }

    protected function refreshToken()
    {
        return Attribute::make(
            get: fn($value) => Crypt::decryptString($value),
            set: fn($value) => Crypt::encryptString($value),
        );
    }
}
