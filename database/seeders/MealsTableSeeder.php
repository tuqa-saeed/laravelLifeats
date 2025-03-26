<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Meal::insert([
            [
                'name' => 'Oatmeal with Berries',
                'description' => 'Whole oats with mixed berries and honey.',
                'calories' => 350,
                'protein' => 10,
                'carbs' => 45,
                'fats' => 8,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 1 // Breakfast
            ],
            [
                'name' => 'Grilled Chicken Salad',
                'description' => 'Chicken breast with mixed greens.',
                'calories' => 450,
                'protein' => 30,
                'carbs' => 10,
                'fats' => 15,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 5 // Salads
            ]
        ]);
    }
}
