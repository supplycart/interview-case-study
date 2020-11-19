<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_history';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get the user that place the order.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'foreign_key', 'user_id');
    }

    /**
     * Get the orders for the user.
     */
    public function orderdetail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    /**
     * Get the orders for the user.
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
