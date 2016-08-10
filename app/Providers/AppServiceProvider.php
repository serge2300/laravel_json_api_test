<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('errors', function () {
            return new \App\Helpers\Errors();
        });
        $this->app->singleton('routing', function () {
            return new \App\Helpers\Routing();
        });
    }
}
