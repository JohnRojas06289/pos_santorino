<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return new \App\Services\CartService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Register Alias dynamically
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Cart', \App\Facades\Cart::class);
    }
}
