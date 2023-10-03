<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'price',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

    public function carts()
    {
        return $this->belongsToMany(User::class, 'user_carts');
    }
}
