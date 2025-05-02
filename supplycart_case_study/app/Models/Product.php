<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'price',
        'premium_price',
        'category_id',
        'brand_id',
        'image_path',
        'description',
        'product_qty'
    ];

     public function category()
     {
         return $this->belongsTo(Category::class);
     }
 
     public function brand()
     {
         return $this->belongsTo(Brand::class);
     }
 
     public function getImageUrlAttribute()
     {
        //  $product->image_url
         if ($this->image_path) {
             return asset($this->image_path);
         }
 
         return asset('images/products/default.png');
     }
}
