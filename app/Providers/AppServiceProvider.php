<?php

namespace App\Providers;

use App\Facades\ViteManifest;
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
            $facade = ViteManifest::class;

            [$entry, $serverUrl] = explode(', ', $expression);

            return sprintf("<?php echo {$facade}::embed(%s, %s); ?>", $entry, $serverUrl);
        });
    }
}
