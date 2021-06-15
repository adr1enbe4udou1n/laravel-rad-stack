<?php

use App\Support\LaravelViteManifest;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function Pest\testDirectory;

beforeEach(function () {
    if (File::exists(public_path('dist'))) {
        return;
    }
    File::makeDirectory(public_path('dist/front'), 0755, true);
    File::copy(testDirectory('manifest.json'), public_path('dist/front/manifest.json'));
});

afterEach(function () {
    File::deleteDirectory(public_path('dist'));
});

test('vite directive should return correct embed call', function () {
    $bladeSnippet = '@vite("front", "http://localhost:3100/app.ts")';
    $expectedCode = '<?php echo App\Facades\ViteManifest::embed("front", "http://localhost:3100/app.ts"); ?>';

    expect($expectedCode)->toBe(Blade::compileString($bladeSnippet));
});

test('vite manifest return no scripts', function () {
    Config::set('vite.dev_server', false);

    $scripts = app(LaravelViteManifest::class)->embed(
        'front',
        'http://localhost:3100/empty.ts'
    );

    expect($scripts)->toBeEmpty();
});

test('vite manifest return dev scripts', function () {
    Config::set('vite.dev_server', true);

    $scripts = app(LaravelViteManifest::class)->embed(
        'front',
        'http://localhost:3100/app.ts'
    );

    expect($scripts)->toMatch('/http:\\/\\/localhost:\\d+\\/app\\.ts/i');
});

test('vite manifest return production scripts', function () {
    Config::set('vite.dev_server', false);

    $url = Str::replace('/', '\/', asset('dist/front/assets'));

    $scripts = app(LaravelViteManifest::class)->embed(
        'front',
        'http://localhost:3100/app.ts'
    );

    expect($scripts)->toMatch("/{$url}\\/app.*\\.js/i");
    expect($scripts)->toMatch("/{$url}\\/vendor.*\\.js/i");
    expect($scripts)->toMatch("/{$url}\\/app.*\\.css/i");
});
