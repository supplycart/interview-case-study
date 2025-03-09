<?php

namespace App\Actions\Modules\User\Cart;

use App\Actions\Models\CartItem\StandardActions as CartItemStandardActions;

class GetListingAction
{
    public static function execute($user, $request = [])
    {
        $request['user_id'] = $user->id;

        $cartItems = CartItemStandardActions::index($request);

        return $cartItems;
    }
}
