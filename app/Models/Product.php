<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }
}
