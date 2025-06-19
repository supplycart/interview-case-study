<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->filamentColor();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
   	     if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }

    public function filamentColor(): void
    {
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Green,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
    }
}
