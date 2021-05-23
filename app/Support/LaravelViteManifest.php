<?php

namespace App\Support;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class LaravelViteManifest
{
    private $manifestCache = [];

    public function embed(string $entry, ?string $serverUrl): string
    {
        if (App::environment('local')) {
            $serverUrl = $serverUrl
                ? Str::of($serverUrl)->rtrim('/')
                : 'http://localhost:3000';

            return $this->jsImports("{$serverUrl}/{$entry}");
        }

        [$manifestKey] = explode('/', $entry);

        return $this->jsImports($this->productionAssets($entry, $manifestKey))
            .$this->jsPreloadImports($entry, $manifestKey)
            .$this->cssImports($entry, $manifestKey);
    }

    private function getManifest(string $key): array
    {
        if (! empty($this->manifestCache[$key])) {
            return $this->manifestCache[$key];
        }

        $content = file_get_contents(public_path("dist/{$key}/manifest.json"));
        $this->manifestCache[$key] = json_decode($content, true);

        return $this->manifestCache[$key];
    }

    private function jsImports(string $url): string
    {
        return "<script type=\"module\" crossorigin src=\"{$url}\"></script>";
    }

    private function jsPreloadImports(string $entry, string $manifestKey): string
    {
        $res = '';
        foreach ($this->preloadUrls($entry, $manifestKey) as $url) {
            $res .= "<link rel=\"modulepreload\" href=\"{$url}\">";
        }

        return $res;
    }

    private function preloadUrls(string $entry, string $manifestKey): array
    {
        $urls = [];
        $manifest = $this->getManifest($manifestKey);

        if (! empty($manifest[$entry]['imports'])) {
            foreach ($manifest[$entry]['imports'] as $imports) {
                $urls[] = asset("/dist/{$manifestKey}/".$manifest[$imports]['file']);
            }
        }

        return $urls;
    }

    private function cssImports(string $entry, string $manifestKey): string
    {
        $tags = '';
        foreach ($this->cssUrls($entry, $manifestKey) as $url) {
            $tags .= "<link rel=\"stylesheet\" href=\"{$url}\">";
        }

        return $tags;
    }

    private function cssUrls(string $entry, string $manifestKey): array
    {
        $urls = [];
        $manifest = $this->getManifest($manifestKey);

        if (! empty($manifest[$entry]['css'])) {
            foreach ($manifest[$entry]['css'] as $file) {
                $urls[] = asset("/dist/{$manifestKey}/{$file}");
            }
        }

        return $urls;
    }

    private function productionAssets(string $entry, string $manifestKey): string
    {
        $manifest = $this->getManifest($manifestKey);

        if (! isset($manifest[$entry])) {
            return '';
        }

        return asset("/dist/{$manifestKey}/".$manifest[$entry]['file']);
    }
}
