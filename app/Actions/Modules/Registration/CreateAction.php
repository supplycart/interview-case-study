<?php

namespace App\Actions\Modules\Registration;

use App\Actions\Models\User\StandardActions as UserStandardActions;

class CreateAction
{
    public static function execute($request)
    {
        $user = UserStandardActions::store($request);

        SendVerificationEmailAction::execute($user);

        return $user;
    }
}
