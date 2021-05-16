<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;

class UserProfileController extends Controller
{
    #[Get('user/profile', name: "profile.show")]
    public function show()
    {
        return Inertia::render('profile/Show');
    }

    #[Delete('user', name: "current-user.destroy")]
    public function destroy(Request $request, StatefulGuard $auth)
    {
        $request->validate([
            'password' => 'required|string|password',
        ]);

        $request->user()->fresh()->delete();

        $auth->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
