<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
  use SoftDeletes;

  protected $table = 'cart_products';

  protected $fillable = [
    'cart_id',
    'product_id',
    'amount'
  ];
}
