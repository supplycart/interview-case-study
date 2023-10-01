<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    public function getPriceAttribute($value) {
        $discount_percentage = Auth::user()->role->discount_percentage ?? 0;

        return number_format((float) (round(($value * (1 - ($discount_percentage / 100))) * 2, 1) / 2), 2, '.', '');
    }

    public function productAttributes() : HasMany {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }
}
