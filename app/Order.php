<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['is_fulfilled', 'user_id'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function userOrders() {
        return $this->hasMany('App\UserOrder');
    }
}
