<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            SubscriptionsTableSeeder::class,
            MealCategoriesTableSeeder::class,
            MealsTableSeeder::class,
            UserSubscriptionsTableSeeder::class,
            MealSchedulesTableSeeder::class,
            MealSelectionsTableSeeder::class,
            PaymentsTableSeeder::class,
        ]);
    }
}
