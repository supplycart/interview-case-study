<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model{
    public function products(){
        return $this->belongsToMany(Product::class, 'user_order_product', 'user_order_id', 'product_id');
    }
}
