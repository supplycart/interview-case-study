<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'price' => 'float'
    ];

    public function countries()
    {
        return $this->hasMany(ProductPriceCountry::class, 'product_price_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
