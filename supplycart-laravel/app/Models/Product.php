<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define category constants
    public const CATEGORIES = [
        'Electronics',
        'Fashion',
        'Beauty',
        'Home',
        'Sports'
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock',
        'category',
        'created_at',
        'updated_at',
        'brand_id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
