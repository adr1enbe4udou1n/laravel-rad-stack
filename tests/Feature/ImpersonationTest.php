<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\Assert;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withSession;

uses(RefreshDatabase::class);

test('user can impersonate other user', function () {
    actingAs(User::factory()->admin()->create());
    $user = User::factory()->create();

    $response = post("/admin/users/{$user->id}/impersonate");

    $response->assertRedirect('/admin/dashboard');
    $response->assertSessionHas('impersonate', $user->id);
});

test('inertia page return impersonated user when impersonate', function () {
    actingAs(User::factory()->superAdmin()->create());
    $user = User::factory()->admin()->create();

    withSession(['impersonate' => $user->id]);

    $response = get('/admin/dashboard');

    $response->assertInertia(
        fn (Assert $page) => $page
            ->component('Dashboard')
            ->where('auth.id', $user->id)
            ->where('auth.is_impersonating', true)
    );
});

test('user can stop impersonate', function () {
    actingAs(User::factory()->superAdmin()->create());
    $user = User::factory()->admin()->create();

    withSession(['impersonate' => $user->id]);

    $response = post('/admin/users/stop-impersonate');

    $response->assertRedirect('/admin/dashboard');
    $response->assertSessionMissing('impersonate');
});

test('user cannot impersonate himself', function () {
    actingAs($user = User::factory()->create());

    $response = post("/admin/users/{$user->id}/impersonate");

    $response->assertForbidden();
});

test('non admin user cannot impersonate', function () {
    actingAs(User::factory()->create());
    $user = User::factory()->create();

    $response = post("/admin/users/{$user->id}/impersonate");

    $response->assertForbidden();
});

test('admin user cannot impersonate super admin user', function () {
    actingAs(User::factory()->admin()->create());
    $user = User::factory()->superAdmin()->create();

    $response = post("/admin/users/{$user->id}/impersonate");

    $response->assertForbidden();
});
