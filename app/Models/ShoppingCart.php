<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ShoppingCart extends Model
{
    protected $fillable = ['user_id', 'quantity', 'product_id','product_name','product_price', 'product_image'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
