<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Event::listen(Login::class, function ($event) {
            activity()
                ->causedBy($event->user)
                ->log('User logged in');
        });

        \Illuminate\Support\Facades\Event::listen(Logout::class, function ($event) {
            activity()
                ->causedBy($event->user)
                ->log('User logged out');
        });
    }
}
