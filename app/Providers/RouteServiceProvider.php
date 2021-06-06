<?php

namespace App\Providers;

use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Spatie\RouteAttributes\RouteRegistrar;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var null|string
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        (new RouteRegistrar(app(Router::class)))
            ->useRootNamespace(app()->getNamespace())
            ->useMiddleware(['web'])
            ->registerDirectory(app_path('Http/Controllers/Front'))
        ;

        (new RouteRegistrar(app(Router::class)))
            ->useRootNamespace(app()->getNamespace())
            ->useMiddleware(['web', 'auth:sanctum'])
            ->registerClass(UserProfileController::class)
        ;

        Route::prefix('admin')
            ->name('admin.')
            ->group(
                function () {
                    (new RouteRegistrar(app(Router::class)))
                        ->useRootNamespace(app()->getNamespace())
                        ->useMiddleware(['web', 'auth:sanctum', 'can:access-admin'])
                        ->registerDirectory(app_path('Http/Controllers/Admin'))
                    ;
                }
            )
        ;
    }
}
