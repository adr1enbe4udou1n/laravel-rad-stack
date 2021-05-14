<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Middleware;

#[Prefix('admin')]
#[Middleware('auth:sanctum')]
class DashboardController extends Controller
{
    #[Get('/')]
    public function redirect()
    {
        return redirect()->route('dashboard');
    }

    #[Get('dashboard', name: "dashboard")]
    public function index()
    {
        return Inertia::render('Dashboard');
    }
}
