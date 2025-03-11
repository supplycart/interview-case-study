<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [
        'id', 'created_at'
    ];

    protected $appends = [
        'financial_unit_price',
        'financial_subtotal',
    ];

    public function getFinancialUnitPriceAttribute()
    {
        return number_format($this->unit_price, 2);
    }

    public function getFinancialSubtotalAttribute()
    {
        return number_format($this->subtotal, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
