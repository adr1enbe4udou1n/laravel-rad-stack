<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;

class DashboardController extends Controller
{
    #[Get('/')]
    public function redirect()
    {
        return redirect()->route('admin.dashboard');
    }

    #[Get('dashboard', name: 'dashboard')]
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    #[Get('user/profile', name: 'profile.show')]
    public function show()
    {
        return Inertia::render('profile/Show');
    }

    #[Get('user/confirm-password', name: 'password.confirm')]
    public function confirmPassword()
    {
        return Inertia::render('auth/ConfirmPassword');
    }
}
