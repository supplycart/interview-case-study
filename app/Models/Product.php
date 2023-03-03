<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Auth;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['discounted_price'];

    public function order_details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function getDiscountedPriceAttribute() {
        if(Auth::user()->membership_level_id) {
            $discount = Auth::user()->membership_level->discount;
            return $this->price - ($this->price * $discount / 100);
        }
        return $this->price;
    }
}
