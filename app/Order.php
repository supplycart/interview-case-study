<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
