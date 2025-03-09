<?php

namespace App\Actions\Modules\User\Cart;

use App\Actions\Models\CartItem\StandardActions as CartItemStandardActions;
use App\Actions\Models\CartItem\CustomActions as CartItemCustomActions;

class CreateAction
{
    // actions not part of Resource standards are placed here
    public static function execute($user, $request)
    {
        $cartItemRequest = $request;
        $cartItemRequest['user_id'] = $user->id;
        $cartItemRequest['subtotal'] = CartItemCustomActions::calculateItemSubtotal($request);

        $cartItem = CartItemStandardActions::store($cartItemRequest);

        return $cartItem;
    }
}
