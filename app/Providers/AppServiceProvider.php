<?php

namespace App\Providers;

use App\Support\LaravelViteManifest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
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

        Builder::macro('paginateWithQuery', function () {
            /** @var Builder */
            $builder = $this;

            /** @var Paginator */
            $paginator = $builder->paginate(min(100, request()->get('perPage', 15)));

            return $paginator->withQueryString();
        });
    }
}
