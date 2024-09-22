<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    
    protected $table = "order_detail";
    protected $fillable = ['product_id', 'product_price', 'coupon_id', 'user_id', 'order_id'];
}
