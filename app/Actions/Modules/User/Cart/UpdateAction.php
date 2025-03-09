<?php

namespace App\Actions\Modules\User\Cart;

use App\Actions\Models\CartItem\StandardActions as CartItemStandardActions;
use App\Actions\Models\CartItem\CustomActions as CartItemCustomActions;

class UpdateAction
{
    // actions not part of Resource standards are placed here
    public static function execute($id, $request)
    {
        $cartItem = CartItemStandardActions::show($id);

        $cartItemRequest = $request;
        $cartItemRequest['quantity'] = $request['quantity'];
        $cartItemRequest['subtotal'] = CartItemCustomActions::calculateItemSubtotal($cartItemRequest);

        $cartItem = CartItemStandardActions::update($cartItem->id, $cartItemRequest);
    }
}
