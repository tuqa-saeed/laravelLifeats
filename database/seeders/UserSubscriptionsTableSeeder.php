<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\UserSubscription::create([
            'user_id' => 1,
            'subscription_id' => 1,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'active',
        ]);
    }
}
