<?php

namespace App\Listeners;

use App\Models\History;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        History::create([
            'user_id' => $event->user->id,
            'event' => 'Logged In',
            'metadata' => "No Metadata Recorded"
        ]);
    }
}
