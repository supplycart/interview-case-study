<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'id',
        'user_id',
        'order_id',
        'item_id',
        'quantity',
        'total',
    ];
}
