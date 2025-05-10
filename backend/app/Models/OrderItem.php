<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'product_name',
        'brand_name',
        'category_name',
        'price_amount',
        'quantity',
        'total',
    ];
}
