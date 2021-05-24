<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('users')]
class UserController extends Controller
{
    #[Get('/', name: 'users.index')]
    public function index()
    {
        return Inertia::render('users/Index');
    }

    #[Get('create', name: 'users.create')]
    public function create()
    {
        return Inertia::render('users/Create');
    }

    #[Get('{user}/edit', name: 'users.edit')]
    public function edit(User $user)
    {
        return Inertia::render('users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
