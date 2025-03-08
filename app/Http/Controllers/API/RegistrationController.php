<?php

namespace App\Http\Controllers\API;

use App\Actions\Modules\General\Registration\CreateAction as RegistrationCreateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\RegistrationRequest;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $registration = RegistrationCreateAction::execute($request->validated());

        $message = "";

        if ($registration)
        {
            $message = "Your account has been successfully registered, you may log into the system with your email and password.";
            // $message = "Your account has been successfully registered, you may log into the system with your email and password after verifying your email.";
        }

        $data = [];
        $data['message'] = $message;

        return $data;
    }

}
