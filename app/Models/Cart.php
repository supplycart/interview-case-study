<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'token', 'user_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getSubTotalAttribute()
    {
        return $this->product->product_price * $this->quantity;
    }
}
