<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakePackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:package {name : The name of the package (Vendor/PackageName)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel package with complete structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $packageName = $this->argument('name');
        
        if (!str_contains($packageName, '/')) {
            $this->error('Package name must be in format Vendor/PackageName');
            return 1;
        }

        [$vendor, $package] = explode('/', $packageName);
        $packagePath = "packages/{$vendor}/{$package}";
        
        if (File::exists($packagePath)) {
            $this->error("Package {$packageName} already exists!");
            return 1;
        }

        $this->info("Creating package: {$packageName}");
        
        // Create directory structure
        $this->createDirectoryStructure($packagePath);
        
        // Create ServiceProvider
        $this->createServiceProvider($vendor, $package, $packagePath);
        
        // Create composer.json
        $this->createComposerJson($vendor, $package, $packagePath);
        
        // Create routes file
        $this->createRoutesFile($packagePath);
        
        // Create basic controller
        $this->createBasicController($vendor, $package, $packagePath);
        
        // Create basic model
        $this->createBasicModel($vendor, $package, $packagePath);
        
        // Create welcome view
        $this->createWelcomeView($packagePath);
        
        $this->info("Package {$packageName} created successfully!");
        $this->info("The package will be auto-loaded by the PackageHelper.");
        
        return 0;
    }

    private function createDirectoryStructure($packagePath)
    {
        $directories = [
            $packagePath,
            "{$packagePath}/src",
            "{$packagePath}/src/Http/Controllers",
            "{$packagePath}/src/Models",
            "{$packagePath}/routes",
            "{$packagePath}/resources/views",
            "{$packagePath}/database/migrations",
            "{$packagePath}/config",
        ];

        foreach ($directories as $directory) {
            File::makeDirectory($directory, 0755, true);
            $this->line("Created directory: {$directory}");
        }
    }

    private function createServiceProvider($vendor, $package, $packagePath)
    {
        $namespace = "{$vendor}\\{$package}";
        $className = Str::studly($package) . 'ServiceProvider';
        
        $stub = $this->getServiceProviderStub($namespace, $className, $package);
        $filePath = "{$packagePath}/src/{$className}.php";
        
        File::put($filePath, $stub);
        $this->line("Created ServiceProvider: {$filePath}");
    }

    private function createComposerJson($vendor, $package, $packagePath)
    {
        $namespace = "{$vendor}\\{$package}";
        $className = Str::studly($package) . 'ServiceProvider';
        
        $composerJson = [
            'name' => strtolower("{$vendor}/{$package}"),
            'description' => "A Laravel package for {$package}",
            'type' => 'library',
            'license' => 'MIT',
            'authors' => [
                [
                    'name' => 'Your Name',
                    'email' => 'your.email@example.com'
                ]
            ],
            'require' => [
                'php' => '^8.2',
                'laravel/framework' => '^12.0'
            ],
            'autoload' => [
                'psr-4' => [
                    "{$namespace}\\" => 'src/'
                ]
            ],
            'extra' => [
                'laravel' => [
                    'providers' => [
                        "{$namespace}\\{$className}"
                    ]
                ]
            ],
            'minimum-stability' => 'stable',
            'prefer-stable' => true
        ];
        
        $filePath = "{$packagePath}/composer.json";
        File::put($filePath, json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->line("Created composer.json: {$filePath}");
    }

    private function createRoutesFile($packagePath)
    {
        $routesContent = "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\n// Package routes go here\nRoute::get('/package', function () {\n    return view('" . basename($packagePath) . "::welcome');\n});\n";
        
        $filePath = "{$packagePath}/routes/web.php";
        File::put($filePath, $routesContent);
        $this->line("Created routes file: {$filePath}");
    }

    private function createBasicController($vendor, $package, $packagePath)
    {
        $namespace = "{$vendor}\\{$package}";
        $controllerName = Str::studly($package) . 'Controller';
        
        $stub = $this->getControllerStub($namespace, $controllerName);
        $filePath = "{$packagePath}/src/Http/Controllers/{$controllerName}.php";
        
        File::put($filePath, $stub);
        $this->line("Created Controller: {$filePath}");
    }

    private function createBasicModel($vendor, $package, $packagePath)
    {
        $namespace = "{$vendor}\\{$package}";
        $modelName = Str::studly($package);
        
        $stub = $this->getModelStub($namespace, $modelName);
        $filePath = "{$packagePath}/src/Models/{$modelName}.php";
        
        File::put($filePath, $stub);
        $this->line("Created Model: {$filePath}");
    }

    private function createWelcomeView($packagePath)
    {
        $packageName = basename($packagePath);
        $viewContent = "<!DOCTYPE html>\n<html>\n<head>\n    <title>{$packageName} Package</title>\n</head>\n<body>\n    <h1>Welcome to {$packageName} Package!</h1>\n    <p>This is a Laravel package view.</p>\n</body>\n</html>";
        
        $filePath = "{$packagePath}/resources/views/welcome.blade.php";
        File::put($filePath, $viewContent);
        $this->line("Created welcome view: {$filePath}");
    }



    private function getServiceProviderStub($namespace, $className, $package)
    {
        return "<?php\n\nnamespace {$namespace};\n\nuse Illuminate\\Support\\ServiceProvider;\nuse Illuminate\\Support\\Facades\\Route;\nuse Illuminate\\Support\\Facades\\View;\n\nclass {$className} extends ServiceProvider\n{\n    /**\n     * Register services.\n     */\n    public function register(): void\n    {\n        //\n    }\n\n    /**\n     * Bootstrap services.\n     */\n    public function boot(): void\n    {\n        // Load routes\n        Route::middleware('web')\n            ->group(__DIR__ . '/../routes/web.php');\n\n        // Load views\n        View::addNamespace('{$package}', __DIR__ . '/../resources/views');\n\n        // Load migrations\n        \$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');\n\n        // Load config\n        \$this->publishes([\n            __DIR__ . '/../config' => config_path('{$package}'),\n        ], '{$package}-config');\n    }\n}\n";
    }

    private function getControllerStub($namespace, $controllerName)
    {
        return "<?php\n\nnamespace {$namespace}\\Http\\Controllers;\n\nuse Illuminate\\Http\\Request;\nuse Illuminate\\Http\\Response;\n\nclass {$controllerName}\n{\n    /**\n     * Display a listing of the resource.\n     */\n    public function index(): Response\n    {\n        return response()->view('" . strtolower(basename($namespace)) . "::welcome');\n    }\n}\n";
    }

    private function getModelStub($namespace, $modelName)
    {
        return "<?php\n\nnamespace {$namespace}\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\nuse Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\n\nclass {$modelName} extends Model\n{\n    use HasFactory;\n\n    protected \$fillable = [\n        //\n    ];\n}\n";
    }
} 