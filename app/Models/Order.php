<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The products that belong to the order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(['order_quantity', 'order_price', 'total_order_price']);
    }

    /**
     * The user that belong to the order.
     */
    public function user()
    {
        return $this->belongsTo(Product::class);
    }
}
