<?php

namespace App\Providers;

use App\Helpers\PackageHelper;
use Illuminate\Support\Facades\View;
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

        // Register the 'admin' namespace for views
        View::addNamespace('admin', base_path('packages/Pharmercy/Admin/resources/views'));

        // Register the 'seller' namespace for views
        View::addNamespace('seller', base_path('packages/Pharmercy/Seller/resources/views'));

        // Register the 'customer' namespace for views
        View::addNamespace('customer', base_path('packages/Pharmercy/Customer/resources/views'));

        // Register the 'web' namespace for views
        View::addNamespace('web', base_path('packages/Pharmercy/Web/resources/views'));
    }
}
