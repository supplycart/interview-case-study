<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [
        'id', 'created_at'
    ];

    protected $casts = [
        'created_at'  => 'date:Y-m-d H:i:s',
    ];

    protected $appends = [
        'financial_subtotal',
        'financial_grand_total',
    ];

    public function getFinancialSubtotalAttribute()
    {
        return number_format($this->subtotal, 2);
    }

    public function getFinancialGrandTotalAttribute()
    {
        return number_format($this->grand_total, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
