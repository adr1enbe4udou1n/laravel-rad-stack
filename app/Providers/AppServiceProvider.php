<?php

namespace App\Providers;

use App\Support\LaravelViteManifest;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Facades\Excel;

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

        Builder::macro('paginateOrExport', function (Closure $response, $resource, $export) {
            /** @var Builder */
            $builder = $this;

            if (request()->get('export')) {
                $fileName = trans_choice("crud.{$resource}.name", 10);
                $date = date('Ymd-His');

                return Excel::download(new $export($builder), "export-{$fileName}-{$date}.xlsx");
            }

            return $response(
                $builder->paginate(min(100, request()->get('perPage', 15)))
            );
        });
    }
}
