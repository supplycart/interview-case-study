<?php

namespace App\Actions\Modules\User\Category;

use App\Actions\Models\Category\StandardActions as CategoryStandardActions;

class GetListingAction
{
    public static function execute($request = [])
    {
        $categories = CategoryStandardActions::index($request);

        return $categories;
    }
}
