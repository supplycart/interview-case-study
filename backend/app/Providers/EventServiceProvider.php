<?php

namespace App\Providers;

use App\Events\UserLoggedOut;
use App\Events\UserLoggedIn;
use App\Events\OrderPlaced;
use App\Listeners\LogUserActivityListener; // Import your listener
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLoggedIn::class => [
            LogUserActivityListener::class,
        ],
        UserLoggedOut::class => [
            LogUserActivityListener::class,
        ],
        OrderPlaced::class => [
            LogUserActivityListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
