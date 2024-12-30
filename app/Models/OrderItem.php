<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_variation_id',
        'product_name',
        'variation_name',
        'price',
        'quantity',
    ];
}
