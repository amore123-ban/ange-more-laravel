<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_commercant_peut_ajouter_un_produit()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/products', [
            'name' => 'Ordinateur portable',
            'price' => 250000,
            'quantity' => 10,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Ordinateur portable',
            'price' => 250000,
        ]);
    }
}
