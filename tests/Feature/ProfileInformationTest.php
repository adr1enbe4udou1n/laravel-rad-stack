<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

uses(RefreshDatabase::class);

test('profile information can be updated', function () {
    actingAs($user = User::factory()->create());

    put('/user/profile-information', [
        'name' => 'Name',
        'email' => 'test@example.com',
    ]);

    expect($user->fresh()->name)->toBe('Name');
    expect($user->fresh()->email)->toBe('test@example.com');
});

test('profile information cannot be updated with invalid data', function (array $data, array $errors) {
    User::factory()->create([
        'email' => 'other@example.com',
    ]);
    actingAs(User::factory()->create());

    $response = put('/user/profile-information', $data);

    $response->assertSessionHasErrorsIn('updateProfileInformation', $errors);
})->with([
    [['email' => 'example.com'], ['email']],
    [['email' => 'other@example.com'], ['email']],
]);
