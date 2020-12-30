<?php

namespace App\Listeners;

use App\Models\History;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        History::create([
            'user_id' => $event->user->id,
            'event' => 'Logged Out',
            'metadata' => "No Metadata Recorded"
        ]);
    }
}
