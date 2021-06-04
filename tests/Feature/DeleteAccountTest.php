<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_accounts_can_be_deleted()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/admin/user', [
            'password' => 'password',
        ]);

        $response->assertRedirect('login');
        $this->assertNull($user->fresh());
        $this->assertGuest('web');
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/admin/user', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertNotNull($user->fresh());
    }
}
