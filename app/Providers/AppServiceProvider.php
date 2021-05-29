<?php

namespace App\Providers;

use App\Support\LaravelViteManifest;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('laravel-vite-manifest', function () {
            return new LaravelViteManifest();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::directive('vite', function ($expression) {
            return '{!! App\Facades\ViteManifest::embed('.$expression.') !!}';
        });
    }
}
