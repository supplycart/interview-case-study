<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'product_prices_id', 'user_id', 'amount', 'total', 'current_price', 'order_id'
    ];

    protected $casts = [
        'current_price' => 'float',
        'total' => 'integer',
        'amount' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function price()
    {
        return $this->belongsTo(ProductPrice::class, 'product_prices_id');
    }

    public function scopeIndex(Builder $query, $ordered = false)
    {
        return $query
            ->with(['product'])
            ->ordered($ordered)
            ->where('user_id', auth()->user()->id);
    }

    public function scopeOrdered(Builder $query, $ordered = false)
    {
        if ($ordered) {
            return $query->whereNotNull('order_id');
        }

        return $query->whereNull('order_id');
    }
}
