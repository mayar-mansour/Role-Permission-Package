<?php

namespace Mayar\RolePermission\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Mayar\RolePermission\Http\Middleware\RoleMiddleware;
use Mayar\RolePermission\Http\Middleware\PermissionMiddleware;

class RolePermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // 1 Load migrations automatically from the package
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

        // 2️ Register Blade directives for permissions and roles
        Blade::if('can', function ($permission) {
            return auth()->check() && auth()->user()->hasPermission($permission);
        });

        Blade::if('role', function ($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

        // 3️⃣ Register middlewares
        $router = $this->app['router'];
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }
}
