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
                'image_url' => 'https://www.shape.com/thmb/DZDr6gQCuHI63T7hrx1Yo2uQ-EU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/bowl-oatmeal-05d8ea77dc034415a2a8c4e696ec4c85.jpg',
                'active' => true
            ],
            [
                'name' => 'Balanced Lifestyle Plan',
                'description' => 'Ideal for general health and energy.',
                'duration_days' => 30,
                'price' => 599.99,
                'goal' => 'balanced',
                'image_url' => 'https://miro.medium.com/v2/resize:fit:1200/1*_WyiMjtf3RdT3dYZBNsuxA.jpeg',
                'active' => true
            ],
            [
                'name' => 'Muscle Gain Plan',
                'description' => 'High-protein meals for building muscle.',
                'duration_days' => 30,
                'price' => 649.99,
                'goal' => 'muscle gain',
                'image_url' => 'https://miro.medium.com/v2/resize:fit:1080/1*S2wYgOWrjnuporCgncnb8g.jpeg',
                'active' => true
            ],
            [
                'name' => 'Vegan Plan',
                'description' => 'Plant-based meals for a vegan lifestyle.',
                'duration_days' => 30,
                'price' => 599.99,
                'goal' => 'vegan',
                'image_url' => 'https://images.everydayhealth.com/images/diet-nutrition/what-is-a-vegan-diet-benefits-food-list-beginners-guide-alt-1440x810.jpg',
                'active' => true
            ],
            [
                'name' => 'Diabetic-Friendly Plan',
                'description' => 'Low-sugar, balanced meals for diabetic health.',
                'duration_days' => 30,
                'price' => 529.99,
                'goal' => 'diabetic',
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQz_VV0e24tJgwumUW-2AJF1IY4TCP5AVAFXA&s',
                'active' => true
            ]
        ]);
    }
}
