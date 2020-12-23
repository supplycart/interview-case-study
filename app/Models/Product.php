<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'stock',
        'brand_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }

    public function carts()
    {
      return $this->hasMany(Cart::class);
    }
}
