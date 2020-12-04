<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ProductContract;
use App\Contracts\OrderContract;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        ProductContract::class => ProductRepository::class,
        OrderContract::class => OrderRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }
    }
}