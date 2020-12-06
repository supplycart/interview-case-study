<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'user_id', 'cart_id'
  ];

  /**
   * Get the products for cart
   */
  public function products()
  {
    return $this->belongsToMany(Product::class, 'order_products')
    ->withPivot([
      'order_id',
      'product_id',
      'amount',
      'id'
    ])
    ->wherePivot('deleted_at', NULL);
  }
}
