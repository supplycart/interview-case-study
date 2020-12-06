<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class Cart extends Model
{
  protected $fillable = [
    'user_id'
  ];

  /**
   * Get the products for cart
   */
  public function products()
  {
    return $this->belongsToMany(Product::class, 'cart_products')
    ->withPivot([
        'cart_id',
        'product_id',
        'amount',
        'id'
    ])
    ->wherePivot('deleted_at', NULL);
  }

  /**
   * Get the products for cart
   */
  public function orders()
  {
    return $this->hasMany(Order::class, 'cart_id');
  }
}
