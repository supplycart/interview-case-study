<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function calculateTotalPrice($items)
    {
        $totalPrice = 0;
        $processedItems = [];

        foreach ($items as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                Log::warning("Product with ID {$item['product_id']} not found.");
                continue;
            }

            $itemPrice = $product->price;
            $itemQuantity = $item['quantity'];

            // Add the subtotal for this item to the total price
            $totalPrice += $itemPrice * $itemQuantity;

            // Prepare processed items for order creation
            $processedItems[] = [
                'product_id' => $product->id,
                'quantity' => $itemQuantity,
                'price' => $itemPrice,
            ];
        }

        return ['total_price' => $totalPrice, 'processed_items' => $processedItems];
    }

    /**
     * Get the user who owns the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items in the cart.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
