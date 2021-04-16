<?php

namespace App\Listeners;

use App\Events\UserLogout;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogout
{
    /**
     * Handle the event.
     *
     * @param  UserLogout  $event
     * @return void
     */
    public function handle(UserLogout $event)
    {
        $user = $event->user;

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'Logged Out',
        ]);
    }
}
