<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'quantity' => 0,
        'picture' => '',
    ];
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['categories', 'brand'];
    /**
     * Get the Brand associated with the product.
     */
    public function brand()
    {
        return $this->belongsTo(
            Brand::class
        );
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The orders that belong to the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}