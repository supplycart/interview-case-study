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

    public function scopeIndex(Builder $query, $search = '')
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->with([
            'prices.countries' => function ($q) {
                // TODO : check based on users country
                return $q->where('country', 'MY');
            }
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
