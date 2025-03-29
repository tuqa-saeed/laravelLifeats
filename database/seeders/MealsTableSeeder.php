<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Meal::insert([
            // Breakfast
            [
                'name' => 'Greek Yogurt Parfait',
                'description' => 'Layered Greek yogurt, granola, and fresh fruits.',
                'calories' => 300,
                'protein' => 15,
                'carbs' => 35,
                'fats' => 9,
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvPR5WDyAOgdguwgFIOLPJYyDZwY3xhWZjhA&s',
                'category_id' => 1,
                'subscription_id' => 1
            ],
            [
                'name' => 'Avocado Toast',
                'description' => 'Whole grain toast topped with mashed avocado and poached egg.',
                'calories' => 320,
                'protein' => 12,
                'carbs' => 28,
                'fats' => 18,
                'image_url' => 'https://www.allrecipes.com/thmb/8NccFzsaq0_OZPDKmf7Yee-aG78=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/AvocadoToastwithEggFranceC4x3-bb87e3bbf1944657b7db35f1383fabdb.jpg',
                'category_id' => 1,
                'subscription_id' => 2
            ],

            // Lunch
            [
                'name' => 'Quinoa and Black Bean Bowl',
                'description' => 'High-protein quinoa bowl with black beans, corn, and avocado.',
                'calories' => 500,
                'protein' => 22,
                'carbs' => 55,
                'fats' => 16,
                'image_url' => 'https://www.allrecipes.com/thmb/TpllGGi3nf-yIreLzwFOPLtdpGc=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/49552_Quinoaandblackbeans_ddmfs_2x1_2746-8b63ca7e76724be3b0065befe1d7d31b.jpg',
                'category_id' => 2,
                'subscription_id' => 4
            ],
            [
                'name' => 'Baked Salmon with Couscous',
                'description' => 'Seasoned baked salmon served with herbed couscous.',
                'calories' => 600,
                'protein' => 35,
                'carbs' => 40,
                'fats' => 25,
                'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLnlYQgs1cHBeCBz37VIoJpQy3-xGb5FxzYA&s',
                'category_id' => 2,
                'subscription_id' => 3
            ],

            // Dinner
            [
                'name' => 'Grilled Steak with Sweet Potatoes',
                'description' => 'Lean grilled beef steak with roasted sweet potatoes.',
                'calories' => 700,
                'protein' => 40,
                'carbs' => 35,
                'fats' => 30,
                'image_url' => 'https://marleyspoon.com/media/recipes/121502/main_photos/medium/bbq_spiced_steak_mashed_sweet_potatoes-7022f2d151976ea46a958c1a1c07a711.jpeg',
                'category_id' => 3,
                'subscription_id' => 3
            ],
            [
                'name' => 'Tofu Stir Fry',
                'description' => 'Crispy tofu with bell peppers and brown rice.',
                'calories' => 450,
                'protein' => 18,
                'carbs' => 48,
                'fats' => 15,
                'image_url' => 'https://www.skinnytaste.com/wp-content/uploads/2021/09/Tofu-Stir-Fry-8-500x500.jpg',
                'category_id' => 3,
                'subscription_id' => 4
            ],

            // Snacks
            [
                'name' => 'Peanut Butter Protein Balls',
                'description' => 'Homemade protein bites with peanut butter and oats.',
                'calories' => 180,
                'protein' => 10,
                'carbs' => 15,
                'fats' => 9,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 4,
                'subscription_id' => 3
            ],
            [
                'name' => 'Chia Seed Pudding',
                'description' => 'Chia pudding made with almond milk and maple syrup.',
                'calories' => 220,
                'protein' => 7,
                'carbs' => 18,
                'fats' => 12,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 4,
                'subscription_id' => 4
            ],

            // Salads
            [
                'name' => 'Kale and Quinoa Salad',
                'description' => 'Chopped kale, quinoa, chickpeas and lemon dressing.',
                'calories' => 350,
                'protein' => 12,
                'carbs' => 30,
                'fats' => 14,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 5,
                'subscription_id' => 2
            ],
            [
                'name' => 'Tuna Niçoise Salad',
                'description' => 'Tuna, boiled egg, green beans, and olives over lettuce.',
                'calories' => 420,
                'protein' => 28,
                'carbs' => 10,
                'fats' => 20,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 5,
                'subscription_id' => 5
            ],

            // More Meals (to make it 20+)
            [
                'name' => 'Vegan Chickpea Curry',
                'description' => 'Chickpeas simmered in tomato coconut curry, served with rice.',
                'calories' => 520,
                'protein' => 17,
                'carbs' => 60,
                'fats' => 18,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 3,
                'subscription_id' => 4
            ],
            [
                'name' => 'Egg White Omelette',
                'description' => 'Egg white omelette with spinach and tomatoes.',
                'calories' => 250,
                'protein' => 20,
                'carbs' => 6,
                'fats' => 10,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 1,
                'subscription_id' => 1
            ],
            [
                'name' => 'Turkey Wrap',
                'description' => 'Lean turkey slices in a whole wheat wrap with veggies.',
                'calories' => 400,
                'protein' => 30,
                'carbs' => 28,
                'fats' => 12,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 2,
                'subscription_id' => 2
            ],
            [
                'name' => 'Lentil Soup',
                'description' => 'Hearty lentil soup with carrots and celery.',
                'calories' => 300,
                'protein' => 15,
                'carbs' => 35,
                'fats' => 8,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 3,
                'subscription_id' => 5
            ],
            [
                'name' => 'Hummus and Veggie Sticks',
                'description' => 'Classic hummus with cucumber, carrots, and bell peppers.',
                'calories' => 200,
                'protein' => 6,
                'carbs' => 20,
                'fats' => 10,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 4,
                'subscription_id' => 4
            ],
            [
                'name' => 'Zucchini Noodles with Pesto',
                'description' => 'Zoodles tossed in basil pesto sauce.',
                'calories' => 330,
                'protein' => 10,
                'carbs' => 20,
                'fats' => 22,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 2,
                'subscription_id' => 5
            ],
            [
                'name' => 'Shrimp and Broccoli Stir Fry',
                'description' => 'Garlic shrimp with steamed broccoli and brown rice.',
                'calories' => 550,
                'protein' => 35,
                'carbs' => 40,
                'fats' => 20,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 3,
                'subscription_id' => 3
            ],
            [
                'name' => 'Berry Smoothie',
                'description' => 'Mixed berry smoothie with almond milk and flax seeds.',
                'calories' => 280,
                'protein' => 8,
                'carbs' => 30,
                'fats' => 10,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 4,
                'subscription_id' => 1
            ],
            [
                'name' => 'Caprese Salad',
                'description' => 'Fresh mozzarella, tomatoes, basil and olive oil.',
                'calories' => 290,
                'protein' => 10,
                'carbs' => 12,
                'fats' => 22,
                'image_url' => 'https://via.placeholder.com/150',
                'category_id' => 5,
                'subscription_id' => 2
            ],
        ]);
    }
}
