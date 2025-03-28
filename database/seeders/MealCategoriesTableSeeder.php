<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MealCategory::insert([
            ['name' => 'Breakfast', 'image' => 'https://via.placeholder.com/150?text=Breakfast'],
            ['name' => 'Lunch', 'image' => 'https://via.placeholder.com/150?text=Lunch'],
            ['name' => 'Dinner', 'image' => 'https://via.placeholder.com/150?text=Dinner'],
            ['name' => 'Snacks', 'image' => 'https://via.placeholder.com/150?text=Snacks'],
            ['name' => 'Salads', 'image' => 'https://via.placeholder.com/150?text=Salads'],
        ]);
    }
}
