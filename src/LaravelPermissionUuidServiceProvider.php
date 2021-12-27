<?php

namespace Jawadabbass\LaravelPermissionUuid;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Router;
use Jawadabbass\LaravelPermissionUuid\Http\Middleware\IsSuperAdmin;
use Illuminate\Support\ServiceProvider;

class LaravelPermissionUuidServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/jawad_permission_uuid.php', 'jawad_permission_uuid');

        $this->app->bind(StatefulGuard::class, function () {
            return Auth::guard(config('jawad_permission_uuid.guard', null));
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
            __DIR__ . '/../assets' => public_path('vender/jawad_permission_uuid'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/jawad_permission_uuid'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/jawad_permission_uuid'),
            __DIR__.'/../config/jawad_permission_uuid.php' => config_path('jawad_permission_uuid.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../routes/jawad_permission_uuid.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'jawad_permission_uuid');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jawad_permission_uuid');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('jpu_is_super_admin', IsSuperAdmin::class);
    }
}
