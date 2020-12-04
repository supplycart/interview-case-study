<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use HasFactory;

    const TABLE_NAME = 'order_product';

    protected $table = self::TABLE_NAME;

    protected $fillable = ['total_price', 'amount', 'price'];
}
