<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function une_vente_est_enregistree_correctement()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create([
            'name' => 'Télévision Samsung',
            'price' => 150000,
            'quantity' => 5,
        ]);

        $response = $this->post('/sales', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect('/sales');
        $this->assertDatabaseHas('sales', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }
}
