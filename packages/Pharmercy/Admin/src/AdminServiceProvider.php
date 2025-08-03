<?php

namespace Pharmercy\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load routes
        Route::middleware('web')
            ->group(__DIR__ . '/../routes/web.php');

        // Load views
        View::addNamespace('Admin', __DIR__ . '/../resources/views');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Load config
        $this->publishes([
            __DIR__ . '/../config' => config_path('Admin'),
        ], 'Admin-config');
    }
}
