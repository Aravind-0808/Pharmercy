# Pharmercy - Modular Laravel Application

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Pharmercy

Pharmercy is a modular Laravel application built with a package-based architecture. This approach allows for better code organization, maintainability, and scalability by separating features into self-contained packages.

### 🏗️ Architecture Overview

- **Modular Design**: Each feature is contained within its own package
- **Auto-Discovery**: Packages are automatically loaded and registered
- **Namespace Isolation**: Each package has its own namespace
- **Self-Contained**: Packages include routes, controllers, models, views, and migrations

## 📦 Package-Based Architecture

### Directory Structure

```
pharmercy/
├── packages/                    # All feature packages
│   └── Pharmercy/              # Vendor namespace
│       ├── Core/               # Core functionality package
│       │   ├── src/
│       │   │   ├── CoreServiceProvider.php
│       │   │   ├── Http/Controllers/
│       │   │   └── Models/
│       │   ├── routes/
│       │   │   └── web.php
│       │   ├── resources/views/
│       │   ├── database/migrations/
│       │   ├── config/
│       │   └── composer.json
│       └── Auth/               # Authentication package
│           └── [similar structure]
├── app/                        # Core application files only
├── routes/                     # Main application routes
└── resources/                  # Main application resources
```

### Package Structure

Each package contains:
- **`src/`** - PHP source code
- **`src/Http/Controllers/`** - Package controllers
- **`src/Models/`** - Package models
- **`routes/web.php`** - Package routes
- **`resources/views/`** - Package views
- **`database/migrations/`** - Package migrations
- **`config/`** - Package configuration
- **`composer.json`** - Package metadata
- **ServiceProvider** - Auto-registration

## 🚀 Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 12.x

### Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd pharmercy
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

## 📋 Creating New Packages

### Using the Artisan Command

The easiest way to create a new package is using the built-in Artisan command:

```bash
php artisan make:package Vendor/PackageName
```

**Examples:**
```bash
# Create a Core package
php artisan make:package Pharmercy/Core

# Create an Authentication package
php artisan make:package Pharmercy/Auth

# Create a Product Management package
php artisan make:package Pharmercy/Products

# Create an Order Management package
php artisan make:package Pharmercy/Orders
```

### What the Command Creates

The `make:package` command automatically creates:

1. **Directory Structure**:
   ```
   packages/Vendor/PackageName/
   ├── src/
   │   ├── PackageNameServiceProvider.php
   │   ├── Http/Controllers/PackageNameController.php
   │   └── Models/PackageName.php
   ├── routes/web.php
   ├── resources/views/welcome.blade.php
   ├── database/migrations/
   ├── config/
   └── composer.json
   ```

2. **Service Provider** - Auto-registers routes, views, and migrations
3. **Basic Controller** - Ready-to-use controller with index method
4. **Basic Model** - Eloquent model with HasFactory trait
5. **Routes File** - Web routes with sample route
6. **Welcome View** - Basic Blade template
7. **Composer.json** - Package metadata and autoloading

### Manual Package Creation

If you prefer to create packages manually:

1. **Create the directory structure**:
   ```bash
   mkdir -p packages/Vendor/PackageName/{src/{Http/Controllers,Models},routes,resources/views,database/migrations,config}
   ```

2. **Create the Service Provider**:
   ```php
   <?php
   
   namespace Vendor\PackageName;
   
   use Illuminate\Support\ServiceProvider;
   use Illuminate\Support\Facades\Route;
   use Illuminate\Support\Facades\View;
   
   class PackageNameServiceProvider extends ServiceProvider
   {
       public function register(): void
       {
           //
       }
   
       public function boot(): void
       {
           // Load routes
           Route::middleware('web')
               ->group(__DIR__ . '/../routes/web.php');
   
           // Load views
           View::addNamespace('PackageName', __DIR__ . '/../resources/views');
   
           // Load migrations
           $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
   
           // Load config
           $this->publishes([
               __DIR__ . '/../config' => config_path('PackageName'),
           ], 'PackageName-config');
       }
   }
   ```

3. **Create routes file** (`routes/web.php`):
   ```php
   <?php
   
   use Illuminate\Support\Facades\Route;
   
   Route::get('/package', function () {
       return view('PackageName::welcome');
   });
   ```

4. **Create composer.json**:
   ```json
   {
       "name": "vendor/package-name",
       "description": "A Laravel package for PackageName",
       "type": "library",
       "license": "MIT",
       "autoload": {
           "psr-4": {
               "Vendor\\PackageName\\": "src/"
           }
       },
       "extra": {
           "laravel": {
               "providers": [
                   "Vendor\\PackageName\\PackageNameServiceProvider"
               ]
           }
       }
   }
   ```

## 🔧 Working with Packages

### Adding Routes

Add routes to your package's `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use Vendor\PackageName\Http\Controllers\PackageNameController;

Route::get('/package', [PackageNameController::class, 'index']);
Route::get('/package/create', [PackageNameController::class, 'create']);
Route::post('/package', [PackageNameController::class, 'store']);
```

### Creating Controllers

Controllers go in `src/Http/Controllers/`:

```php
<?php

namespace Vendor\PackageName\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageNameController
{
    public function index(): Response
    {
        return response()->view('PackageName::index');
    }
    
    public function create(): Response
    {
        return response()->view('PackageName::create');
    }
    
    public function store(Request $request): Response
    {
        // Handle form submission
        return redirect()->route('package.index');
    }
}
```

### Creating Models

Models go in `src/Models/`:

```php
<?php

namespace Vendor\PackageName\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}
```

### Creating Views

Views go in `resources/views/` and are namespaced:

```php
// In your controller
return view('PackageName::index');

// In your Blade files
@extends('PackageName::layouts.app')
```

### Creating Migrations

Migrations go in `database/migrations/`:

```bash
# Create migration file manually in database/migrations/
# Or use Laravel's make:migration command and move the file
```

## 🔄 Auto-Loading

Packages are automatically discovered and loaded by the `PackageHelper` class:

- **Auto-Discovery**: Scans the `packages/` directory
- **Service Provider Registration**: Automatically registers all service providers
- **Route Loading**: Loads package routes with web middleware
- **View Namespacing**: Adds view namespaces for each package

### Package Helper Methods

```php
use App\Helpers\PackageHelper;

// Get all loaded packages
$packages = PackageHelper::getLoadedPackages();

// Check if a package exists
$exists = PackageHelper::packageExists('Vendor', 'PackageName');

// Get package path
$path = PackageHelper::getPackagePath('Vendor', 'PackageName');
```

## 🧪 Testing Packages

### Testing Package Routes

```bash
# Test package routes
php artisan route:list

# Access package routes in browser
http://localhost:8000/package
```

### Testing Package Views

```php
// In your package controller
return view('PackageName::welcome');
```

## 📁 Moving Existing Code to Packages

### Step-by-Step Migration

1. **Identify Features**: Determine which features should be packages
2. **Create Packages**: Use `make:package` command
3. **Move Controllers**: Move from `app/Http/Controllers/` to package `src/Http/Controllers/`
4. **Move Models**: Move from `app/Models/` to package `src/Models/`
5. **Move Views**: Move from `resources/views/` to package `resources/views/`
6. **Move Routes**: Move from `routes/web.php` to package `routes/web.php`
7. **Update Namespaces**: Update all namespace references
8. **Test**: Ensure everything works correctly

### Example Migration

**Before (Traditional Laravel)**:
```
app/
├── Http/Controllers/
│   ├── UserController.php
│   └── ProductController.php
├── Models/
│   ├── User.php
│   └── Product.php
resources/views/
├── users/
└── products/
routes/web.php
```

**After (Package-Based)**:
```
packages/
├── Pharmercy/Users/
│   ├── src/
│   │   ├── Http/Controllers/UserController.php
│   │   └── Models/User.php
│   ├── routes/web.php
│   └── resources/views/
└── Pharmercy/Products/
    ├── src/
    │   ├── Http/Controllers/ProductController.php
    │   └── Models/Product.php
    ├── routes/web.php
    └── resources/views/
```

## 🎯 Best Practices

### Package Naming

- Use PascalCase for package names: `Pharmercy/UserManagement`
- Use descriptive names that reflect the feature
- Keep packages focused on a single responsibility

### File Organization

- Keep related files together within the package
- Use consistent naming conventions
- Document your package's purpose and usage

### Dependencies

- Minimize dependencies between packages
- Use interfaces for package communication
- Keep packages loosely coupled

### Testing

- Write tests for each package
- Test package integration
- Use feature tests for package functionality

## 🚨 Troubleshooting

### Common Issues

1. **Package Not Loading**:
   - Check if ServiceProvider exists
   - Verify namespace in composer.json
   - Clear application cache: `php artisan cache:clear`

2. **Routes Not Working**:
   - Check route file exists in package
   - Verify route registration in ServiceProvider
   - Clear route cache: `php artisan route:clear`

3. **Views Not Found**:
   - Check view namespace registration
   - Verify view file exists
   - Clear view cache: `php artisan view:clear`

### Debug Commands

```bash
# List all routes
php artisan route:list

# List all packages
php artisan tinker
>>> App\Helpers\PackageHelper::getLoadedPackages()

# Clear all caches
php artisan optimize:clear
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Package Development](https://laravel.com/docs/packages)
- [PSR-4 Autoloading Standard](https://www.php-fig.org/psr/psr-4/)

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
