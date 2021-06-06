<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;

class AuthController extends Controller
{
    #[Get('login', name: 'login')]
    public function login()
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('admin.password.request'),
            'status' => session('status'),
        ]);
    }

    #[Get('forgot-password', name: 'password.request')]
    public function requestPasswordResetLink()
    {
        return Inertia::render('auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    #[Get('reset-password/{token}', name: 'password.reset')]
    public function resetPassword(string $token, Request $request)
    {
        return Inertia::render('auth/ResetPassword', [
            'email' => $request->query('email'),
            'token' => $token,
        ]);
    }

    #[Get('register', name: 'register')]
    public function register()
    {
        return Inertia::render('auth/Register');
    }
}
