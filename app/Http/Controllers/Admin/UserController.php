<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Queries\UserQuery;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\RouteAttributes\Attributes\Delete;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Put;

#[Prefix('users')]
class UserController extends Controller
{
    #[Get('/', name: 'users')]
    public function index()
    {
        return app(UserQuery::class)->make()
            ->paginateOrExport(fn ($data) => Inertia::render('users/Index', ['action' => 'list'] + $data))
        ;
    }

    #[Get('create', name: 'users.create')]
    public function create()
    {
        return Inertia::render('users/Index', [
            'action' => 'create',
        ] + app(UserQuery::class)->make()->get());
    }

    #[Get('{user}', name: 'users.show')]
    public function show(User $user)
    {
        return Inertia::render('users/Index', [
            'action' => 'show',
            'user' => UserResource::make($user),
        ] + app(UserQuery::class)->make()->get());
    }

    #[Get('{user}/edit', name: 'users.edit')]
    public function edit(User $user)
    {
        return Inertia::render('users/Index', [
            'action' => 'edit',
            'user' => UserResource::make($user),
        ] + app(UserQuery::class)->make()->get());
    }

    #[Post('/', name: 'users.store')]
    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('admin.users')->with('flash.success', __('User created.'));
    }

    #[Put('{user}', name: 'users.update')]
    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->validated());

        return redirect()->route('admin.users')->with('flash.success', __('User updated.'));
    }

    #[Delete('{user}', name: 'users.destroy')]
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('flash.success', __('User deleted.'));
    }

    #[Post('{user}/impersonate', name: 'users.impersonate')]
    public function impersonate(User $user)
    {
        abort_unless(Auth::user()->canImpersonate(), 403);

        if ($user->canBeImpersonated()) {
            Auth::user()->setImpersonating($user->id);

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('flash.danger', __('Impersonate disabled for this user.'));
    }

    #[Post('stopImpersonate', name: 'users.stop-impersonate')]
    public function stopImpersonate()
    {
        Auth::user()->stopImpersonating();

        session()->flash('flash.success', __('Welcome Back!'));

        return redirect()->route('admin.dashboard');
    }
}
