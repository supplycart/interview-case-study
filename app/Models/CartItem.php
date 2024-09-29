<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Good;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'good_id', 'quantity'];

    protected $appends = ['unit_price'];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function unitPrice(): Attribute
    {
        return Attribute::get(fn () => $this->good->price);
    }
}
