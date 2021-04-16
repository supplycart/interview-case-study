<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogUserResetPassword
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $user = $event->user;

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Reset Password',
        ]);
    }
}
