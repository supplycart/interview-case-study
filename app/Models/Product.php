<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Price;

class Product extends Model
{
  use SoftDeletes;

  protected $dates = [
      'deleted_at'
  ];

  /**
   * Get the brands for products
   */
  public function price()
  {
    return $this->hasOne(Price::class, 'product_id');
  }

  /**
   * Get the brands for products
   */
  public function priceAmount()
  {
    return $this->price->amount;
  }


  /**
   * Get the brands for products
   */
  public function brands()
  {
    return $this->belongsToMany(Brand::class, 'product_brands')
      ->withPivot([
        'brand_id',
        'product_id',
        'id'
      ]);  
  }

  /**
   * Get the categories for products
   */
  public function categories()
  {
    return $this->belongsToMany(Category::class, 'product_categories')
      ->withPivot([
        'category_id',
        'product_id',
        'id'
      ]);  
  }
}
