<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderitems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'cost'];

    public function user() {
        return $this->hasOne(Orders::class);
    }

    public function product() {
        return $this->hasMany(Products::class);
    }
}
