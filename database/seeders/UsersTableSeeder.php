<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'phone' => '1234567890',
            'address' => '123 Wellness St',
            'role' => 'user',
            'preferences' => 'Low carb, no red meat',
            'allergies' => 'peanuts'
        ]);
    }
}
