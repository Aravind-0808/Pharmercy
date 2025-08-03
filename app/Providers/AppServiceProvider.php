<?php

namespace App\Providers;

use App\Helpers\PackageHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-load all packages
        PackageHelper::loadPackages();
    }
}
