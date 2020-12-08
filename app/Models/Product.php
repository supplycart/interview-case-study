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
        })->with([
            'prices.countries' => function ($q) {
                // TODO : check based on users country
                return $q->where('country', 'MY');
            }, 'category', 'brand'
        ])->whereHas('prices.countries', function ($q) {
            return $q->where('country', 'MY');
        });
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }
}
