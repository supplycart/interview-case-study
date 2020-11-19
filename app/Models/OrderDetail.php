<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_detail';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'product_id';

    //orderDetails belongs to one order placement
    public function orderhistory()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

}
