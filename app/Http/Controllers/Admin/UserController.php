<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\GlobalSearchFilter;
use Inertia\Inertia;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('users')]
class UserController extends Controller
{
    #[Get('/', name: 'users')]
    public function index()
    {
        return Inertia::render('users/Index', [
            'users' => QueryBuilder::for(User::class)
                ->allowedFilters([
                    AllowedFilter::custom('q', new GlobalSearchFilter(['name', 'email'])),
                    AllowedFilter::partial('name'),
                    AllowedFilter::partial('email'),
                    AllowedFilter::exact('id'),
                    AllowedFilter::exact('role'),
                    AllowedFilter::exact('active'),
                ])
                ->allowedSorts(['id', 'name', 'email', 'created_at', 'last_login_at'])
                ->paginateWithQuery()
                ->through(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'active' => $user->active,
                    'role' => $user->role,
                    'last_login_at' => $user->last_login_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]),
        ]);
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
