<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\App\Contexts\Security\Providers\SecurityServiceProvider::class);
        $this->app->register(\App\Contexts\Shared\Providers\SharedServiceProvider::class);
        $this->app->register(\App\Contexts\Dashboard\Providers\DashboardServiceProvider::class);
        $this->app->register(\App\Contexts\Public\Providers\PublicServiceProvider::class);
        $this->app->register(\App\Contexts\Viviendas\Providers\ViviendasServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
