<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Log as logger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Container\Attributes\Log;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('goods.index').'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            logger::info('Email verified', ['user' => $request->user()]);
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('goods.index').'?verified=1');
    }
}
