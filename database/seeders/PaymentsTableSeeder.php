<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Payment::create([
            'user_subscription_id' => 1, // must match created user_subscription
            'amount' => 499.99,
            'method' => 'manual',
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);
    }
}
