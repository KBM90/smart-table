<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Starters', 'slug' => 'starters', 'sort_order' => 1],
            ['name' => 'Soups & Salads', 'slug' => 'soups-salads', 'sort_order' => 2],
            ['name' => 'Main Course', 'slug' => 'main-course', 'sort_order' => 3],
            ['name' => 'Pizza & Pasta', 'slug' => 'pizza-pasta', 'sort_order' => 4],
            ['name' => 'Sandwiches & Wraps', 'slug' => 'sandwiches-wraps', 'sort_order' => 5],
            ['name' => 'Desserts', 'slug' => 'desserts', 'sort_order' => 6],
            ['name' => 'Hot Beverages', 'slug' => 'hot-beverages', 'sort_order' => 7],
            ['name' => 'Cold Beverages', 'slug' => 'cold-beverages', 'sort_order' => 8],
            ['name' => 'Cocktails & Mocktails', 'slug' => 'cocktails-mocktails', 'sort_order' => 9],
            ['name' => 'Specials', 'slug' => 'specials', 'sort_order' => 10],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insertOrIgnore([
                ...$category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}