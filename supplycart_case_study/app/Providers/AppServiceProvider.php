<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquent\OrderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
