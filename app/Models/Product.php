<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'stock'
    ];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function scopeIndex(Builder $query, $search = '', $categoryId = '', $brandId = '')
    {
        return $query->where(function ($q) use ($search, $categoryId, $brandId) {
            return $q->when($search, function ($q) use ($search) {
                return $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        })->when($categoryId, function ($q) use ($categoryId) {
            return $q->where('category_id', $categoryId);
        })->when($brandId, function ($q) use ($brandId) {
            return $q->where('brand_id', $brandId);
        })->whereHas('prices', function ($q) {
            return $q->priceCountry();
        })->with(['prices' => function($q) {
            return $q->priceCountry();
        }, 'category', 'brand']);
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }
}
