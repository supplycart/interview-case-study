<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
