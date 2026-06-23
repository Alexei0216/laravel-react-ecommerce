<?php

namespace App\Models;

use App\Enums\UserAddressType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'type',
    'country_code',
    'province',
    'city',
    'postal_code',
    'address_line_1',
    'address_line_2',
    'delivery_notes',
    'phone',
    'recipient_name',
    'is_default'
])]

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected function casts(): array
    {
        return [
            'type' => UserAddressType::class,
            'is_default' => 'boolean'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isShipping(): bool
    {
        return $this->type === UserAddressType::SHIPPING;
    }

    public function isBilling(): bool
    {
        return $this->type === UserAddressType::BILLING;
    }
}
