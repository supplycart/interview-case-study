<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogUserFailedLoginAttempt
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        $request = $event->request;
        $user = User::where('email', 'like', "%{$request->input('email')}%")->first();

        if ($user) {
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'Failed Login Attempt',
                'remark' => serialize($request),
            ]);
        }
    }
}
