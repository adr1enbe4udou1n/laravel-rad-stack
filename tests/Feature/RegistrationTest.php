<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Inertia\Testing\Assert;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertInertia(fn (Assert $page) => $page->component('auth/Register'));
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_can_register_with_strong_password_if_debug_disabled()
    {
        Config::set('app.debug', false);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'p4$$w0rD',
            'password_confirmation' => 'p4$$w0rD',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function invalidData()
    {
        yield [
            [
                'name' => 'Test User',
                'email' => 'example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
            ['email'],
        ];

        yield [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password',
                'password_confirmation' => 'wrong-password',
            ],
            ['password'],
        ];
    }

    /**
     * @dataProvider invalidData
     */
    public function test_new_users_cannot_register_with_invalid_data(array $data, array $errors)
    {
        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors($errors);
    }

    public function invalidPasswords()
    {
        yield ['password'];
        yield ['PassWord'];
        yield ['p4ssw0rd'];
        yield ['pa$$word'];
    }

    /**
     * @dataProvider invalidPasswords
     */
    public function test_new_users_cannot_register_with_weak_password_if_debug_disabled(string $password)
    {
        Config::set('app.debug', false);

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertSessionHasErrors('password');
    }
}
