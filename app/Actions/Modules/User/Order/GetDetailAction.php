<?php

namespace App\Actions\Modules\User\Order;

use App\Actions\Models\Order\StandardActions as OrderStandardActions;

class GetDetailAction
{
    // actions not part of Resource standards are placed here
    public static function execute($id)
    {
        $order = OrderStandardActions::show($id);

        return $order;
    }
}
