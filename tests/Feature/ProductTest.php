<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_product_creation()
    {
        $user = User::factory()->create();

        $category = Category::create(['nom' => 'Ordinateurs']);

        $shop = Shop::create([
            'nom' => 'Boutique Test',
            'description' => 'Description de la boutique',
            'adresse' => '123 Rue nkolanga',
            'telephone' => '+237 683 456 789',
            'user_id' => $user->id,   
        ]);

        $product = Product::create([
            'nom' => 'Ordinateur Portable',
            'description' => 'Ordinateur portable haute performance',
            'prix' => 350000,
            'quantite' => 15,
            'category_id' => $category->id,
            'quantite_min' => 5,
            'shop_id' => $shop->id,
        ]);

        $this->assertDatabaseHas('products', [
            'nom' => 'Ordinateur Portable',
            'prix' => 350000,
            'quantite' => 15,
            'category_id' => $category->id,
            'shop_id' => $shop->id,
        ]);
    }
}
