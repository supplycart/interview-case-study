<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class Product extends Model
{
    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

}
