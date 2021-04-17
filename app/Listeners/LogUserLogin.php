<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogin
{
    /**
     * Handle the event.
     *
     * @param  n  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {
        $user = $event->user;

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Logged In',
        ]);
    }
}
