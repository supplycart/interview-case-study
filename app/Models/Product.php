<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function carts()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function special_prices()
    {
        return $this->hasMany('App\Models\SpecialPrice');
    }
    
}
