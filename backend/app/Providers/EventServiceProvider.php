<?php

namespace App\Providers;

use App\Events\UserLoggedOut; // Import the UserLoggedOut event
use App\Events\UserLoggedIn; // Import the UserLoggedIn event (assuming you have this event)
use App\Events\OrderPlaced; // Import the OrderPlaced event (assuming you have this event)
use App\Listeners\LogUserActivityListener; // Import your listener
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
