<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'total_amount', 'address', 'status'];

    public function items()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
}
