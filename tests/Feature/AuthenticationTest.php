<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\getJson;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

test('admin login screen can be rendered', function () {
    $response = get('/admin/login');

    $response->assertInertia(fn (Assert $page) => $page->component('auth/Login'));
});

test('authenticated admin should be redirected to admin when go to login page', function () {
    actingAs(User::factory()->admin()->create());

    $response = get('/admin/login');

    $response->assertRedirect('/admin');
});

test('guest user should be redirected to login when intent go to authenticated page', function () {
    $response = get('/admin');

    $response->assertRedirect('/admin/login');
});

test('guest user should be unauthorized to do authenticated json request', function () {
    $response = getJson('/admin/users');

    $response->assertUnauthorized();
});

test('admin should be redirected to dashboard when intent go to admin home', function () {
    actingAs(User::factory()->admin()->create());

    $response = get('/admin');

    $response->assertRedirect('/admin/dashboard');
});

test('admin can go to dashboard', function () {
    actingAs($user = User::factory()->admin()->create());

    $response = get('/admin/dashboard');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('Dashboard')
            ->where('auth.id', $user->id)
            ->where('auth.is_impersonating', false)
    );
});

test('non admin cannot go to admin dashboard', function () {
    actingAs(User::factory()->user()->create());

    $response = get('/admin/dashboard');

    $response->assertForbidden();
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    assertGuest();
});

test('users can logout', function () {
    actingAs(User::factory()->create());

    $response = post('/logout');

    $response->assertRedirect('/admin/login');
    assertGuest('web');
});

test('users can logout with json', function () {
    actingAs(User::factory()->create());

    $response = postJson('/logout');

    $response->assertStatus(204);
    assertGuest('web');
});
