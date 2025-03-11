<?php

namespace App\Actions\Modules\General\Authentication;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public static function execute(Request $request)
    {
        // delete all tokens, essentially logging the user out
        auth()->user()->tokens()->delete();

        // delete the current token that was used for the request
        $request->user()->currentAccessToken()->delete();
    }
}
