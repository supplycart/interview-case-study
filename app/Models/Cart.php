<?php

namespace App\Models;

use App\CartStatus;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            // new carts always have pending checkout cart status
            $model->status = CartStatus::PENDING_CHECKOUT->value;
        });
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
