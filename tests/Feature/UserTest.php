<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_created()
    {
        $user = User::create([
            'name' => 'Abena justin',
            'email' => 'ajustin21@gmail.com',
            'password' => bcrypt('Everabj123'),
            'role' => 'proprietaire',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Abena justin',
            'email' => 'ajustin21@gmail.com',
            'role' => 'proprietaire',
        ]);
    }
}
