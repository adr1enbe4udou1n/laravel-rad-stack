<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;

class UserController extends Controller
{
    #[Get('users', name: 'users')]
    public function index()
    {
        return Inertia::render('users/Index');
    }
}
