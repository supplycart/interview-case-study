<?php

namespace App\Actions\Modules\User\Order;

use App\Actions\Models\Order\StandardActions as OrderStandardActions;

class GetListingAction
{
    // actions not part of Resource standards are placed here
    public static function execute($user, $request = [])
    {
        $request['user_id'] = $user->id;

        $cartItems = OrderStandardActions::index($request);

        return $cartItems;
    }
}
