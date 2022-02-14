<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use OwenIt\Auditing\Models\Audit;
use Carbon\Carbon;
use Auth;

class LogSuccessfulLogin implements ShouldQueue
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
     * @param  SlotWasModified  $event
     * @return void
     */
    public function handle($event)
    {
        $data = [
            'auditable_id'   => Auth::user()->id,
            'auditable_type' => "App\Models\User",
            'event'          => "login",
            'url'            => request()->fullUrl(),
            'ip_address'     => request()->getClientIp(),
            'user_agent'     => request()->userAgent(),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
            'user_id'        => Auth::user()->id,
        ];
        Audit::create($data);
    }
}