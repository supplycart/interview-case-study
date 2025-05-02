<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'receipt_no',
        'total',
        'full_name',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
