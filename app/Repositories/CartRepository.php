<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use App\Models\OrderDetail;

class CartRepository extends BaseRepository
{
    public function model()
    {
        return OrderDetail::class;
    }
    
    public function addToOrderDetail($product, $coupon_id, $user_id){
        OrderDetail::create([
            'product_id' => $product->id,
            'product_price' => $product->product_price,
            'coupon_id' => $coupon_id,
            'user_id' => $user_id,
        ]);
    }
    
}
