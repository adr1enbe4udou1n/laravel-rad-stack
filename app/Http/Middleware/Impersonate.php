<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Impersonate
{
    /**
     * Handle an incoming request.
     *
     * @param mixed $request
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('impersonate')) {
            Auth::onceUsingId($request->session()->get('impersonate'));
        }

        return $next($request);
    }
}
