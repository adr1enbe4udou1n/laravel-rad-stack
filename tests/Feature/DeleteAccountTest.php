<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\delete;

uses(RefreshDatabase::class);

test('user accounts can be deleted', function () {
    actingAs($user = User::factory()->create());

    $response = delete('/profile/user', [
        'password' => 'password',
    ]);

    $response->assertRedirect('/login');
    expect($user->fresh())->toBeNull();
    assertGuest('web');
});

test('correct password must be provided before account can be deleted', function () {
    actingAs($user = User::factory()->create());

    $response = delete('/profile/user', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
    expect($user->fresh())->toBeObject();
});
