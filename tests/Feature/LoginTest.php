<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('platform.login.auth'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirectToRoute('platform.main');
        $this->assertAuthenticatedAs($user);
    }

    public function test_a_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('platform.login.auth'), [
            'email' => 'invalid@example.com',
            'password' => 'password',
        ]);
        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
    }
}
