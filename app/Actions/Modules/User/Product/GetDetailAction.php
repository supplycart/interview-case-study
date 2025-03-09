<?php

namespace App\Actions\Modules\User\Product;

use App\Actions\Models\Product\StandardActions as ProductStandardActions;

class GetDetailAction
{
    public static function execute($id)
    {
        $product = ProductStandardActions::show($id);

        return $product;
    }
}
