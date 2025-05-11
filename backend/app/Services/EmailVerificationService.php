<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest as LaravelEmailVerificationRequest;
use Illuminate\Http\Request; // For resend notification

class EmailVerificationService
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param int $userId
     * @return bool True if email was verified, false if already verified.
     */
    public function verifyEmail(int $userId): bool
    {
        /** @var User $user */
        $user = User::find($userId);

        if ($user->hasVerifiedEmail()) {
            return false; // Already verified
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            return true;
        }
        return false; // Should not happen if not already verified
    }

    /**
     * Resend the email verification notification.
     *
     * @param Request $request
     * @return bool True if email was sent, false if already verified.
     */
    public function resendVerificationNotification(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return false; // Already verified
        }

        $user->sendEmailVerificationNotification();
        return true;
    }
}
