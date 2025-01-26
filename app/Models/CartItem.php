<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cart;
use App\Models\Product;
class CartItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Relationship with Cart model
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}