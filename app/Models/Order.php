<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $dates = ['craeted_at'];

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'phone',
        'email',
        'subtotal',
        'delivery',
        'discount',
        'total',
    ];

    protected $visible = [
        'id',
        'user_id',
        'firstname',
        'lastname',
        'address',
        'phone',
        'email',
        'subtotal',
        'delivery',
        'discount',
        'total',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product',
            'order_id', 'product_id',
            'id', 'id')->using(OrderProduct::class)->withPivot('price','count');
    }
}
