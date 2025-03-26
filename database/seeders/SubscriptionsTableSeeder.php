<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Subscription::insert([
            [
                'name' => 'Weight Loss Plan',
                'description' => 'Low-calorie meals for healthy weight loss.',
                'duration_days' => 30,
                'price' => 499.99,
                'goal' => 'weight loss',
                'active' => true
            ],
            [
                'name' => 'Balanced Lifestyle Plan',
                'description' => 'Ideal for general health and energy.',
                'duration_days' => 30,
                'price' => 599.99,
                'goal' => 'balanced',
                'active' => true
            ]
        ]);
    }
}
