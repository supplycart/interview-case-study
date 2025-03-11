<?php

namespace App\Actions\Modules\User\Product;

use App\Actions\Models\Product\StandardActions as ProductStandardActions;

class GetDetailAction
{
    public static function execute($id, $user = null)
    {
        $product = ProductStandardActions::show($id);

        $price = $product->base_price;
        if (isset($user))
        {
            $price = $user->is_member ? $product->discounted_price_for_member : $product->base_price;
        }
        $product->price = number_format($price, 2);

        return $product;
    }
}
