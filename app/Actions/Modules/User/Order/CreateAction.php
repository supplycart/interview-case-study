<?php

namespace App\Actions\Modules\User\Order;

use App\Actions\Models\OrderItem\StandardActions as OrderItemStandardActions;
use App\Actions\Models\CartItem\CustomActions as CartItemCustomActions;
use App\Actions\Models\Order\StandardActions as OrderStandardActions;
use App\Actions\Models\Order\CustomActions as OrderCustomActions;
use App\Models\CartItem;
use App\Models\User;

class CreateAction
{
    // actions not part of Resource standards are placed here
    public static function execute($request)
    {
        $userId = $request['user_id'];
        $cartItemIds = $request['cart_item_ids'];

        $cartItems = CartItem::whereIn('id', $cartItemIds)->get();
        $cartItemsSubtotal = $cartItems->pluck('subtotal')->toArray();

        $subtotal = OrderCustomActions::calculateSubtotal($cartItemsSubtotal);
        $roundingAdjustment = OrderCustomActions::calculateRoundingAdjustment($subtotal);
        $discountAmount = 0; // $request['discount_amount] // NOTE: not within scope
        $grandTotal = OrderCustomActions::calculateGrandTotal($subtotal, $roundingAdjustment, $discountAmount);

        $user = User::find($userId);

        $orderRequest = [];
        $orderRequest['user_id'] = $userId;
        $orderRequest['phone_no'] = $user->phone_no;
        $orderRequest['address_line_1'] = $user->address_line_1;
        $orderRequest['address_line_2'] = $user->address_line_2;
        $orderRequest['address_line_3'] = $user->address_line_3;
        $orderRequest['email'] = $user->email;
        $orderRequest['number'] = OrderCustomActions::generateDocumentNumber($request['user_id']);
        $orderRequest['subtotal'] = $subtotal;
        $orderRequest['rounding_adjustment'] = $roundingAdjustment;
        $orderRequest['discount_amount'] = $discountAmount;
        $orderRequest['grand_total'] = $grandTotal;

        $order = OrderStandardActions::store($orderRequest);

        foreach ($cartItems as $cartItem)
        {
            $orderItemRequest = [];
            $orderItemRequest['order_id'] = $order->id;
            $orderItemRequest['product_id'] = $cartItem->product_id;
            $orderItemRequest['product_title'] = $cartItem->product_title;
            $orderItemRequest['product_description'] = $cartItem->product_description;
            $orderItemRequest['unit_price'] = $cartItem->unit_price;
            $orderItemRequest['quantity'] = $cartItem->quantity;
            $orderItemRequest['subtotal'] = $cartItem->subtotal;

            OrderItemStandardActions::store($orderItemRequest);
        }

        // refresh $order to have linkage with order items
        $order = OrderStandardActions::show($order->id);

        // before return, need to clear the cart item
        CartItemCustomActions::bulkDelete($cartItemIds);

        return $order;
    }
}
