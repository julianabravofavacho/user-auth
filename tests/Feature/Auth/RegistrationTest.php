<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Juliana Bravo',
            'email' => 'juliana@example.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'juliana@example.com',
        ]);

        $this->assertAuthenticated();
    }

    public function test_user_cannot_register_with_duplicate_email()
    {
        $existing = User::factory()->create([
            'email' => 'duplicado@email.com',
        ]);

        $response = $this->from('/register')->post('/register', [
            'name' => 'Outro',
            'email' => 'duplicado@email.com',
            'password' => 'Senha@123',
            'password_confirmation' => 'Senha@123',
        ]);

        $response->assertRedirect('/register');
        $this->assertGuest();
    }
}
