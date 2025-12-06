<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * This method is used for binding classes into the service container,
     * registering custom implementations, or loading additional packages.
     */
    public function register(): void
    {
        // Register bindings or additional services here
    }

    /**
     * Bootstrap any application services.
     * This method is executed after all services have been registered.
     * Useful for configuration, model observers, or global settings.
     */
    public function boot(): void
    {
        // Bootstrap or configure services here
    }
}