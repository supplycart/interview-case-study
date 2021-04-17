<?php

namespace App\Listeners;

use App\Events\UserModifyRank;
use App\Models\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserModifyRank
{
    /**
     * Handle the event.
     *
     * @param  UserModifyRank  $event
     * @return void
     */
    public function handle(UserModifyRank $event)
    {
        $user = $event->user;

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => "Modify Rank ({$user->rank->name})",
        ]);
    }
}
