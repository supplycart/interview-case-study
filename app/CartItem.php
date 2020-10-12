<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $guarded = [];

    public function cart() {
        return $this->hasOne(Cart::class);
    }
}
