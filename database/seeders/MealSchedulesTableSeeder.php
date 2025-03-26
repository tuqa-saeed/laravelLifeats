<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MealSchedule::create([
            'user_subscription_id' => 1,
            'date' => now()->toDateString(),
            'locked' => false
        ]);
    }
}
