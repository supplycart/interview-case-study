<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock',
        'created_at',
        'updated_at'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
