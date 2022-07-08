<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Auth;

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
        view()->composer('*', function($view){
            $cart = 0;
            // if(Auth::check()){
            //     $cart = count(Cart::where('user_id',Auth::user()->id)->groupBy(['id','color','size'])->get());
                View::share('cart',$cart);
            // }
        });
    }
}
