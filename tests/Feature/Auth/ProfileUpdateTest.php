<?php

namespace Tests\Feature\Profile;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_update_name_email_and_image()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->put(route('profile.update'), [
            'name' => 'Novo Nome',
            'email' => 'novo@email.com',
            'profile_image' => $file,
        ]);

        $response->assertRedirect();
        $user->refresh();

        $this->assertEquals('Novo Nome', $user->name);
        $this->assertEquals('novo@email.com', $user->email);

        // Verifica se a imagem foi armazenada
        Storage::disk('public')->assertExists($user->profile_image);
    }
}
