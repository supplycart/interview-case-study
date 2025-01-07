<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Listeners\LogLoginActivity;
use App\Helpers\helpers;


class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogLoginActivity::class,
        ],
    ];

    public function handle(Login $event)
    {
        ActivityLogService::log('User Logged In', 'User ' . $event->user->name . ' logged in.');
    }
}

