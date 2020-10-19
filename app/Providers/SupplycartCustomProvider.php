<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SupplycartCustomProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\ProductContract', 'App\Services\ProductService');
        $this->app->bind('App\Contracts\OrderContract', 'App\Services\OrderService');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
