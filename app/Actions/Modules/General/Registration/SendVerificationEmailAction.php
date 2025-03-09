<?php

namespace App\Actions\Modules\General\Registration;

use App\Models\User;

class SendVerificationEmailAction
{
    public static function execute(User $user) : void
    {
        // TODO: send email using mailgun/mailtrap
    }
}
