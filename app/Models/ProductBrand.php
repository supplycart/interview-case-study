<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $fillable = ['name'];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_brands', 'brand_id', 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
