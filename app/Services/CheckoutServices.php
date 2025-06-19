<?php

namespace App\Services;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;

class CheckoutServices
{
    public function placeOrder($carts, $total)
    {
        try {
            DB::beginTransaction();

            $order = Orders::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'processing'
        ]);

        foreach($carts as $cart) {
            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'subtotal' => $cart->quantity * $cart->product->price,
            ]);
        }

        DB::commit();

        // clear cart process
        Auth::user()->carts()->delete();

        Notification::make()
            ->title('Order Success')
            ->body('The order placed successfully!')
            ->success()
            ->iconColor('success')
            ->send();

        }catch(Exception $e) {

            DB::rollBack();

            Notification::make()
                ->title('Order Failed')
                ->body('The order placed is failed!')
                ->danger()
                ->iconColor('danger')
                ->send();
        }
 
    }

     
}
