<?php

namespace App\Actions\Modules\User\Cart;

use App\Actions\Models\CartItem\StandardActions as CartItemStandardActions;

class DeleteAction
{
    // actions not part of Resource standards are placed here
    public static function execute($id)
    {
        $cartItem = CartItemStandardActions::delete($id);

        return $cartItem;
    }
}
