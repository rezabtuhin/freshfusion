<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $categories = [
            'Fast Food',
            'Italian Cuisine',
            'Chinese Cuisine',
            'Japanese Cuisine',
            'Mexican Cuisine',
            'Indian Cuisine',
            'Mediterranean Cuisine',
            'Vegetarian/Vegan',
            'Seafood',
            'Desserts/Sweets',
            'Barbecue/Grill',
            'Salads',
            'Sandwiches/Wraps',
            'Breakfast/Brunch',
            'Beverages (Non-alcoholic)',
            'Cocktails/Alcoholic Beverages',
            'Soups',
            'Pizza',
            'Burgers',
            'Pasta',
        ];
        foreach ($categories as $category){
            Category::factory()->create([
                'name' => $category
            ]);
        }
    }
}
