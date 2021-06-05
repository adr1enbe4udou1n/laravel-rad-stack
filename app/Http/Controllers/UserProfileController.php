<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('profile')]
class UserProfileController extends Controller
{
    #[Delete('user', name: 'current-user.destroy')]
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
