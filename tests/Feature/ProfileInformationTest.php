<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = User::factory()->create());

        $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }

    public function invalidData()
    {
        yield [['email' => 'example.com'], ['email']];
        yield [['email' => 'other@example.com'], ['email']];
    }

    /**
     * @dataProvider invalidData
     */
    public function test_profile_information_cannot_be_updated_with_invalid_data(array $data, array $errors)
    {
        User::factory()->create([
            'email' => 'other@example.com',
        ]);
        $this->actingAs(User::factory()->create());

        $response = $this->put('/user/profile-information', $data);

        $response->assertSessionHasErrorsIn('updateProfileInformation', $errors);
    }
}
