<?php

use App\Support\LaravelViteManifest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

test('vite manifest return no scripts', function () {
    Config::set('vite.dev_server', false);

    $scripts = app(LaravelViteManifest::class)->embed(
        'front',
        'http://localhost:3100/empty.ts'
    );

    dump($scripts);
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
