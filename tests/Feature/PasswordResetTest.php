<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Inertia\Testing\Assert;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('reset password link screen can be rendered', function () {
    $response = get('/forgot-password');

    $response->assertInertia(
        fn (Assert $page) => $page->component('auth/ForgotPassword')
    );
});

test('reset password screen can be rendered', function () {
    Notification::fake();

    $user = User::factory()->create();

    post('/forgot-password', [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
        $response = get('/reset-password/'.$notification->token);

        $response->assertInertia(
            fn (Assert $page) => $page->component('auth/ResetPassword')
        );

        return true;
    });
});

test('password can be reset with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    post('/forgot-password', [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $response = post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasNoErrors();

        return true;
    });
});

test('password cannot be reset with invalid token', function () {
    $user = User::factory()->create();

    $response = post('/reset-password', [
        'token' => Str::random(),
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors();

    return true;
});
