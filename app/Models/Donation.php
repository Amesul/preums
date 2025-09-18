<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'timestamp',
        'username',
        'message',
        'processed',
        'amount',
        'id',
    ];

    protected function casts(): array
    {
        return [
            'timestamp' => 'timestamp',
            'processed' => 'boolean',
            'amount'    => 'integer',
        ];
    }

    protected function formattedAmount(): Attribute
    {
        return Attribute::make(get: fn() => $this->amount / 100 . '€');
    }

    protected function timestamp()
    {
        return Attribute::make(get: fn($value) => Carbon::parse($value)
                                                        ->format('d H:i'));
    }
}