<?php

namespace App\Actions\Modules\General\Authentication;

use Illuminate\Support\Facades\Auth;

class GetAuthenticatedUserAction
{
    public static function execute()
    {
        $user = Auth::user();

        return $user;
    }
}
