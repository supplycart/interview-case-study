<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\ProductAddedToCart;
use App\Listeners\LogCartProduct;
use App\Listeners\LogFailedLogin;
use App\Listeners\LogRegisteredUser;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Listeners\LogSuccessfulOrder;
use App\Listeners\LogSuccessfulVerification;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
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
        Failed::class => [
            LogFailedLogin::class,
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        OrderCreated::class => [
            LogSuccessfulOrder::class,
        ],
        ProductAddedToCart::class => [
            LogCartProduct::class,
        ],
        Registered::class => [
            LogRegisteredUser::class,
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            LogSuccessfulVerification::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
