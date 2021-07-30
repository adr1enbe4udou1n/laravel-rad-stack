<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function glide(string $path, Request $request)
    {
        if ($key = config('glide.key')) {
            SignatureFactory::create($key)
                ->validateRequest($request->path(), $request->only([
                    'ts', 'w', 'h', 'fit', 's',
                ]))
            ;
        }

        $server = ServerFactory::create([
            'response' => new SymfonyResponseFactory(),
            'source' => Storage::disk('public')->getDriver(),
            'cache' => storage_path('glide'),
            'driver' => config('glide.driver'),
        ]);

        return $server->getImageResponse($path, $request->query());
    }
}
