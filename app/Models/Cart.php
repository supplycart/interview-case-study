<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartProduct;

class Cart extends Model
{
  protected $fillable = [
    'user_id'
  ];

  /**
   * Get the cart for user
   */
  public function products()
  {
    return $this->belongsToMany(Product::class, 'cart_products')
    ->withPivot([
        'cart_id',
        'product_id',
    ]);  
  }
}
