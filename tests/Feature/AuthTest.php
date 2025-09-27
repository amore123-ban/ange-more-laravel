<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function un_utilisateur_peut_se_connecter()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard'); 
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function un_utilisateur_invalide_ne_peut_pas_se_connecter()
    {
        $response = $this->post(route('login'), [
            'email' => 'fake@email.com',
            'password' => 'wrongpass',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
