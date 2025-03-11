<?php

namespace App\Actions\Modules\General\Registration;

use App\Actions\Models\User\StandardActions as UserStandardActions;
use Illuminate\Auth\Events\Registered;

class CreateAction
{
    public static function execute($request)
    {
        $user = UserStandardActions::store($request);

        event(new Registered($user));

        return $user;
    }
}
