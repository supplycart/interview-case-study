<?php

namespace App\Services;

use App\Models\Carts;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;

class CartServices
{
   
    public function addToCart(Product $product, int $quantity=1)
    {
        // Get user and product
        $userId = Auth::id();
        $productId = $product->id;

        // Check the stock quantity
        if ($product->stock_quantity < $quantity) {

            return Notification::make()
                ->title('Low Stock')
                ->body('The product failed to add in your cart.')
                ->icon('heroicon-o-document-text')
                ->iconColor('danger')
                ->send();
        }

        // Find existing cart item
        $cart = Carts::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

        if ($cart) {
            // Update existing cart
            $cart->quantity += $quantity;
            $cart->save();

        } else {
            // Create new cart record
            Carts::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

        }

        Notification::make()
                ->title('Added to Cart')
                ->body('The product has been added to your cart.')
                ->success()
                ->iconColor('success')
                ->send();

        // Decrease product stock
        $product->decrement('stock_quantity', $quantity);

        return redirect()->back();
    }
    
    public function getCartItem()
    {
        $user =  Auth::user();
        return $user->carts()->with('product')->get();

    }

    public function calculateCartSubTotal()
    {
        return $this->getCartItem()->sum(function ($cart) {
            return $cart->quantity * $cart->product->price;
        });
    }

}
