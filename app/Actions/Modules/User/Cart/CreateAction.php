<?php

namespace App\Actions\Modules\User\Cart;

use App\Actions\Models\CartItem\StandardActions as CartItemStandardActions;
use App\Actions\Models\CartItem\CustomActions as CartItemCustomActions;

class CreateAction
{
    // actions not part of Resource standards are placed here
    public static function execute($user, $request)
    {
        $userId = $user->id;
        $productId = $request['product_id'];

        $filterRequest = [];
        $filterRequest['filters'] = [];
        $filterRequest['filters']['user_id'] = $userId;
        $filterRequest['filters']['product_id'] = $productId;

        $cartItems = CartItemStandardActions::index($filterRequest)->keyBy('product_id');
        if (isset($cartItems[$productId]))
        {
            $cartItem = $cartItems[$productId];

            $cartItemRequest = $request;
            $cartItemRequest['quantity'] = $cartItem->quantity + $request['quantity'];
            $cartItemRequest['user_id'] = $userId;
            $cartItemRequest['subtotal'] = CartItemCustomActions::calculateItemSubtotal($cartItemRequest);

            $cartItem = CartItemStandardActions::update($cartItem->id, $cartItemRequest);
        }
        else
        {
            $cartItemRequest = $request;
            $cartItemRequest['user_id'] = $userId;
            $cartItemRequest['subtotal'] = CartItemCustomActions::calculateItemSubtotal($cartItemRequest);

            $cartItem = CartItemStandardActions::store($cartItemRequest);
        }

        return $cartItem;
    }
}
