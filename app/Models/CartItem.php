<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'image',
        'price',
        'description',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'float:2'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
