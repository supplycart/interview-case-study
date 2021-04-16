<?php

namespace App\Providers;

use App\Events\UserLogin;
use App\Events\UserLogout;
use App\Events\UserPlacedOrder;
use App\Listeners\LogUserFailedLoginAttempt;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserLogout;
use App\Listeners\LogUserPlacedOrder;
use App\Listeners\LogUserRegistered;
use App\Listeners\LogUserResetPassword;
use App\Listeners\LogUserVerifiedEmail;
use App\Models\CartItem;
use App\Models\User;
use App\Observers\CartItemObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            LogUserRegistered::class,
        ],
        Verified::class => [
            LogUserVerifiedEmail::class,
        ],
        PasswordReset::class => [
            LogUserResetPassword::class,
        ],
        Lockout::class => [
            LogUserFailedLoginAttempt::class,
        ],
        UserLogin::class => [
            LogUserLogin::class,
        ],
        UserLogout::class => [
            LogUserLogout::class,
        ],
        UserPlacedOrder::class => [
            LogUserPlacedOrder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Observers
        User::observe(UserObserver::class);
        CartItem::observe(CartItemObserver::class);
    }
}
