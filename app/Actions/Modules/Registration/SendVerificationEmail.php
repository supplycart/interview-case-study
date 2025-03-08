<?php

namespace App\Actions\Modules\Registration;

use App\Models\User;

class SendVerificationEmail
{
    public static function execute(User $user) : void
    {
        // TODO: send email using mailgun/mailtrap
    }
}
