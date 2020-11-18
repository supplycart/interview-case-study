<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function orderItem()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
