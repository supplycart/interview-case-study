<?php

namespace App\Actions\Modules\User\Product;

use App\Actions\Models\Product\StandardActions as ProductStandardActions;

class GetListingAction
{
    public static function execute($user, $request = [])
    {
        $products = ProductStandardActions::index($request);

        foreach ($products as $product)
        {
            $price = $user->is_member ? $product->discounted_price_for_member : $product->base_price;
            $product->price = number_format($price, 2);
        }

        return $products;
    }
}
