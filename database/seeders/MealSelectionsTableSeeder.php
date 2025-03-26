<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSelectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MealSelection::create([
            'meal_schedule_id' => 1,
            'category_id' => 1, // Breakfast
            'meal_id' => 1
        ]);
    }
}
