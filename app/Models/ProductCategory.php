<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name'];

    public function brands()
    {
        return $this->belongsToMany(ProductBrand::class, 'category_brands', 'category_id', 'brand_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
