<?php

namespace App\Providers;

use App\Events\OrderAboutToBePlaced;
use App\Events\OrderPlaced;
use App\Listeners\Order\CachePreviousOrders;
use App\Listeners\Order\DecreaseOrderStock;
use App\Listeners\RemoveCachePreviousDeliveryOrders;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderAboutToBePlaced::class => [
            RemoveCachePreviousDeliveryOrders::class,
        ],
        OrderPlaced::class => [
            DecreaseOrderStock::class,
            CachePreviousOrders::class
        ]
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
