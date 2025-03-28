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
            ['name' => 'Breakfast', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRm4nTDOsrHZwI3FAcGwx0ZAz8zb8MuHSs42Q&s'],
            ['name' => 'Lunch', 'image' => 'https://www.eatingwell.com/thmb/zSh86Cx-fybgBu5-baxombw1OiA=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/diy-taco-lunch-box-54f8791776b64900b285fbfc22a4f0bc.jpg'],
            ['name' => 'Dinner', 'image' => 'https://images.immediate.co.uk/production/volatile/sites/30/2017/08/crispy-sesame-lemon-chicken-8830c24.jpg?quality=90&resize=556,505'],
            ['name' => 'Snacks', 'image' => 'https://hips.hearstapps.com/hmg-prod/images/chia-pudding-with-kiwi-granola-and-almonds-in-a-jar-royalty-free-image-1642112572.jpg?crop=1.00xw:0.667xh;0.00170xw,0.163xh&resize=980:*'],
            ['name' => 'Salads', 'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjEEVFJ9nawvrcvvAvepsX03zHBo0PWQwTCw&s'],
        ]);
    }
}
