<?php

namespace Pharmercy\Web;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class WebServiceProvider extends ServiceProvider
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
        View::addNamespace('Web', __DIR__ . '/../resources/views');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Load config
        $this->publishes([
            __DIR__ . '/../config' => config_path('Web'),
        ], 'Web-config');
    }
}
