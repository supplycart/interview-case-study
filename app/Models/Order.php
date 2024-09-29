<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'user_address_id',
        'promo_code_id',
        'delivery_method',
        'payment_method',
        'goods_cost',
        'delivery_cost',
        'total_cost',
        'status',
        'status_history',
    ];

    protected $casts = [
        'goods_cost' => 'float',
        'delivery_cost' => 'float',
        'total_cost' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
