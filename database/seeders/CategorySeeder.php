<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Électronique'],
            ['nom' => 'Vêtements'],
            ['nom' => 'Alimentation'],
            ['nom' => 'Maison & Jardin'],
            ['nom' => 'Sport & Loisirs'],
            ['nom' => 'Livres'],
            ['nom' => 'Beauté & Santé'],
            ['nom' => 'Automobile'],
            ['nom' => 'Bébé & Enfant'],
            ['nom' => 'Autres'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}