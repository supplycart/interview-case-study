<?php

namespace App\Actions\Orders;

use App\Helpers\MasterLookupHelper;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreOrderAction
{
    public function execute(array $orderData)
    {
        $user             = Auth::user();
        $productsFromCart = $user
            ->carts()
            ->with('product')
            ->get();

        $originalPrice = $productsFromCart->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $discount = $productsFromCart->sum(function ($cart) {
            return $cart->product->discount * $cart->quantity;
        });

        try {
            DB::beginTransaction();

            $order                       = new Order();
            $order->user_id              = $user->getKey();
            $order->total_original_price = $originalPrice;
            $order->total_discount       = $discount;
            $order->total_payment        = $originalPrice - $discount;
            $order->status_id            = MasterLookupHelper::getStatusID('order_status', 'pending');
            $order->payment_date         = now();
            $order->save();

            $orderItems = $productsFromCart->map(function ($cart) {
                return [
                    'product_id'     => $cart->product_id,
                    'quantity'       => $cart->quantity,
                    'original_price' => $cart->product->price,
                    'discount'       => $cart->product->discount,
                    'total_price'    => ($cart->product->price - $cart->product->discount) * $cart->quantity,
                ];
            });

            $order->items()->createMany($orderItems);

            $orderAddress = [
                'name'     => $orderData['name'],
                'phone'    => $orderData['phone'],
                'email'    => $orderData['email'],
                'address'  => $orderData['address'],
                'city'     => $orderData['city'],
                'zip_code' => $orderData['zipCode'],
                'state'    => $orderData['state'],
            ];

            $order->address()->create($orderAddress);

            $orderPaymentInformation = [
                'card_number'     => $orderData['cardNumber'],
                'expiration_date' => $orderData['cardExpiration'],
            ];

            $order->paymentInfo()->create(array_merge($orderPaymentInformation, [
                'status_id' => MasterLookupHelper::getStatusID('payment_status', 'paid'),
            ]));

            if ($orderData['saveInfo']) {
                $user->update($orderAddress);
                $user->paymentInfo()->updateOrCreate([], $orderPaymentInformation);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $order->order_number;
    }
}
