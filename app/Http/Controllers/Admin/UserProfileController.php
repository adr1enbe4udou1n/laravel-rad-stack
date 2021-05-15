<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;

class UserProfileController extends Controller
{
    #[Get('user/profile', name: "profile.show")]
    public function show()
    {
        return Inertia::render('profile/Show');
    }
}
