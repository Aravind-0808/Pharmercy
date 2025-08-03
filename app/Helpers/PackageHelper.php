<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class PackageHelper
{
    /**
     * Auto-load all packages from the packages directory
     */
    public static function loadPackages(): void
    {
        $packagesPath = base_path('packages');
        
        if (!File::exists($packagesPath)) {
            return;
        }

        $vendorDirs = File::directories($packagesPath);
        
        foreach ($vendorDirs as $vendorDir) {
            $vendor = basename($vendorDir);
            $packageDirs = File::directories($vendorDir);
            
            foreach ($packageDirs as $packageDir) {
                $package = basename($packageDir);
                self::loadPackage($vendor, $package, $packageDir);
            }
        }
    }

    /**
     * Load a specific package
     */
    public static function loadPackage(string $vendor, string $package, string $packagePath): void
    {
        $namespace = "{$vendor}\\{$package}";
        $serviceProviderClass = "{$namespace}\\{$package}ServiceProvider";
        
        // Check if ServiceProvider exists
        $serviceProviderPath = "{$packagePath}/src/{$package}ServiceProvider.php";
        
        if (File::exists($serviceProviderPath)) {
            // Load the service provider file
            require_once $serviceProviderPath;
            
            // Register the service provider
            app()->register($serviceProviderClass);
        } else {
            // Fallback: Load routes and views manually
            self::loadPackageRoutes($packagePath, $package);
            self::loadPackageViews($packagePath, $package);
        }
    }

    /**
     * Load package routes
     */
    private static function loadPackageRoutes(string $packagePath, string $package): void
    {
        $routesPath = "{$packagePath}/routes/web.php";
        
        if (File::exists($routesPath)) {
            Route::middleware('web')
                ->group($routesPath);
        }
    }

    /**
     * Load package views
     */
    private static function loadPackageViews(string $packagePath, string $package): void
    {
        $viewsPath = "{$packagePath}/resources/views";
        
        if (File::exists($viewsPath)) {
            View::addNamespace($package, $viewsPath);
        }
    }

    /**
     * Get all loaded packages
     */
    public static function getLoadedPackages(): array
    {
        $packages = [];
        $packagesPath = base_path('packages');
        
        if (!File::exists($packagesPath)) {
            return $packages;
        }

        $vendorDirs = File::directories($packagesPath);
        
        foreach ($vendorDirs as $vendorDir) {
            $vendor = basename($vendorDir);
            $packageDirs = File::directories($vendorDir);
            
            foreach ($packageDirs as $packageDir) {
                $package = basename($packageDir);
                $packages[] = "{$vendor}/{$package}";
            }
        }

        return $packages;
    }

    /**
     * Check if a package exists
     */
    public static function packageExists(string $vendor, string $package): bool
    {
        $packagePath = base_path("packages/{$vendor}/{$package}");
        return File::exists($packagePath);
    }

    /**
     * Get package path
     */
    public static function getPackagePath(string $vendor, string $package): ?string
    {
        $packagePath = base_path("packages/{$vendor}/{$package}");
        return File::exists($packagePath) ? $packagePath : null;
    }
} 