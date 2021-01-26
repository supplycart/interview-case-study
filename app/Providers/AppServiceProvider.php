<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Order; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('\App\Repositories\OrderRepository', function(){
            return new NewsRepositoryEloquent(new Order);
        });
    }
}
