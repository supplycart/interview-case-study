<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productPrice()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function rankedProductPrice()
    {
        $user = Auth::user();

        return $this->hasOne(ProductPrice::class)->whereHas('rank', function ($query) use ($user) {
            return $query->where('id', $user->rank_id);
        });
    }
}
