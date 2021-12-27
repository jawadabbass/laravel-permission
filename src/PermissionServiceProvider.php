<?php

namespace Jawad\Permission;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Router;
use Jawad\Permission\Http\Middleware\IsSuperAdmin;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/jawad_permission.php', 'jawad_permission');

        $this->app->bind(StatefulGuard::class, function () {
            return Auth::guard(config('jawad_permission.guard', null));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../assets' => public_path('vender/jawad_permission'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/jawad_permission'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/jawad_permission'),
            __DIR__.'/../config/jawad_permission.php' => config_path('jawad_permission.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/jawad_permission.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'jawad_permission');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jawad_permission');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('jawad_permission_is_super_admin', IsSuperAdmin::class);
    }
}
