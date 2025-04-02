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
        \App\Models\Meal::insert(
            [
                // Breakfast
                [
                    'name' => 'Greek Yogurt Parfait',
                    'description' => 'Layered Greek yogurt, granola, and mixed berries.',
                    'calories' => 300,
                    'protein' => 15,
                    'carbs' => 35,
                    'fats' => 9,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1, // Breakfast
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Oatmeal with Banana & Cinnamon',
                    'description' => 'Steel-cut oats topped with banana slices and cinnamon.',
                    'calories' => 340,
                    'protein' => 9,
                    'carbs' => 45,
                    'fats' => 10,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 2
                ],

                // Lunch
                [
                    'name' => 'Grilled Chicken Bowl',
                    'description' => 'Grilled chicken with brown rice, broccoli, and tahini sauce.',
                    'calories' => 500,
                    'protein' => 40,
                    'carbs' => 45,
                    'fats' => 15,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Quinoa & Chickpea Salad',
                    'description' => 'Refreshing salad with quinoa, chickpeas, cherry tomatoes, and parsley.',
                    'calories' => 420,
                    'protein' => 18,
                    'carbs' => 48,
                    'fats' => 14,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 3
                ],

                // Dinner
                [
                    'name' => 'Lemon Herb Baked Salmon',
                    'description' => 'Salmon fillet baked with herbs, served with steamed veggies.',
                    'calories' => 580,
                    'protein' => 38,
                    'carbs' => 20,
                    'fats' => 30,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Tofu Stir-Fry with Rice Noodles',
                    'description' => 'Marinated tofu stir-fried with vegetables and gluten-free noodles.',
                    'calories' => 490,
                    'protein' => 22,
                    'carbs' => 50,
                    'fats' => 18,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 5
                ],

                // Snacks
                [
                    'name' => 'Peanut Butter Energy Balls',
                    'description' => 'Rolled oats, peanut butter, honey, and flaxseed energy bites.',
                    'calories' => 180,
                    'protein' => 6,
                    'carbs' => 15,
                    'fats' => 10,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Hummus & Veggie Sticks',
                    'description' => 'Classic hummus served with cucumber, carrots, and bell pepper sticks.',
                    'calories' => 150,
                    'protein' => 5,
                    'carbs' => 12,
                    'fats' => 8,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 3
                ],

                // Salads
                [
                    'name' => 'Kale Caesar Salad',
                    'description' => 'Chopped kale with light Caesar dressing, parmesan, and sunflower seeds.',
                    'calories' => 350,
                    'protein' => 10,
                    'carbs' => 20,
                    'fats' => 22,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Mediterranean Lentil Salad',
                    'description' => 'Lentils, red onion, cucumbers, olive oil, lemon juice, and mint.',
                    'calories' => 380,
                    'protein' => 16,
                    'carbs' => 35,
                    'fats' => 14,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 4
                ],

                // Breakfast
                [
                    'name' => 'Spinach & Feta Omelette',
                    'description' => 'Fluffy omelette with sautéed spinach and crumbled feta cheese.',
                    'calories' => 310,
                    'protein' => 20,
                    'carbs' => 6,
                    'fats' => 24,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 4
                ],
                [
                    'name' => 'Chia Seed Pudding',
                    'description' => 'Chia seeds soaked in almond milk with a drizzle of honey and berries.',
                    'calories' => 290,
                    'protein' => 10,
                    'carbs' => 25,
                    'fats' => 16,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 5
                ],

                // Lunch
                [
                    'name' => 'Turkey & Avocado Wrap',
                    'description' => 'Whole wheat wrap with turkey breast, avocado, lettuce, and tomato.',
                    'calories' => 430,
                    'protein' => 28,
                    'carbs' => 35,
                    'fats' => 18,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Vegan Buddha Bowl',
                    'description' => 'Brown rice, roasted chickpeas, sweet potato, tahini drizzle.',
                    'calories' => 480,
                    'protein' => 20,
                    'carbs' => 55,
                    'fats' => 17,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 5
                ],

                // Dinner
                [
                    'name' => 'Zucchini Noodles with Pesto',
                    'description' => 'Spiralized zucchini tossed in homemade basil pesto.',
                    'calories' => 420,
                    'protein' => 12,
                    'carbs' => 15,
                    'fats' => 30,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 4
                ],
                [
                    'name' => 'Stuffed Bell Peppers',
                    'description' => 'Baked bell peppers filled with ground turkey, quinoa, and veggies.',
                    'calories' => 540,
                    'protein' => 32,
                    'carbs' => 40,
                    'fats' => 22,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 1
                ],

                // Snacks
                [
                    'name' => 'Cottage Cheese & Pineapple',
                    'description' => 'Protein-packed cottage cheese served with pineapple chunks.',
                    'calories' => 200,
                    'protein' => 16,
                    'carbs' => 12,
                    'fats' => 9,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Almond Date Bars',
                    'description' => 'Homemade almond and date energy bars with no added sugar.',
                    'calories' => 190,
                    'protein' => 5,
                    'carbs' => 20,
                    'fats' => 11,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 3
                ],

                // Salads
                [
                    'name' => 'Thai Peanut Slaw',
                    'description' => 'Cabbage, carrots, red peppers, and peanut-lime dressing.',
                    'calories' => 360,
                    'protein' => 10,
                    'carbs' => 25,
                    'fats' => 22,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 4
                ],
                [
                    'name' => 'Classic Garden Salad with Tuna',
                    'description' => 'Mixed greens, cucumber, tomatoes, and tuna with olive oil dressing.',
                    'calories' => 400,
                    'protein' => 30,
                    'carbs' => 12,
                    'fats' => 24,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 1
                ],

                // Breakfast
                [
                    'name' => 'Protein Pancakes',
                    'description' => 'Fluffy pancakes made with oats and whey protein, topped with berries.',
                    'calories' => 380,
                    'protein' => 25,
                    'carbs' => 40,
                    'fats' => 12,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 3
                ],
                [
                    'name' => 'Mushroom & Spinach Scramble',
                    'description' => 'Scrambled eggs with sautéed mushrooms and spinach.',
                    'calories' => 290,
                    'protein' => 20,
                    'carbs' => 6,
                    'fats' => 20,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 5
                ],

                // Lunch
                [
                    'name' => 'Grilled Shrimp Tacos',
                    'description' => 'Corn tortillas filled with grilled shrimp, slaw, and avocado crema.',
                    'calories' => 510,
                    'protein' => 30,
                    'carbs' => 38,
                    'fats' => 24,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 4
                ],
                [
                    'name' => 'Chicken Shawarma Bowl',
                    'description' => 'Spiced grilled chicken with brown rice, pickled onions, and tahini.',
                    'calories' => 560,
                    'protein' => 38,
                    'carbs' => 45,
                    'fats' => 22,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 2
                ],

                // Dinner
                [
                    'name' => 'Beef Stir-Fry with Veggies',
                    'description' => 'Lean beef sautéed with bell peppers and snap peas in garlic sauce.',
                    'calories' => 600,
                    'protein' => 40,
                    'carbs' => 30,
                    'fats' => 28,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Eggplant Parmesan Bake',
                    'description' => 'Baked eggplant layers with tomato sauce and light mozzarella.',
                    'calories' => 470,
                    'protein' => 22,
                    'carbs' => 40,
                    'fats' => 22,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 5
                ],

                // Snacks
                [
                    'name' => 'Boiled Eggs with Sea Salt',
                    'description' => 'Two organic boiled eggs sprinkled with Himalayan salt.',
                    'calories' => 140,
                    'protein' => 13,
                    'carbs' => 1,
                    'fats' => 9,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Greek Yogurt & Honey Dip',
                    'description' => 'Thick yogurt with a swirl of raw honey and crushed walnuts.',
                    'calories' => 180,
                    'protein' => 10,
                    'carbs' => 15,
                    'fats' => 8,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 2
                ],

                // Salads
                [
                    'name' => 'Arugula & Beet Salad',
                    'description' => 'Fresh arugula with roasted beets, goat cheese, and walnuts.',
                    'calories' => 390,
                    'protein' => 9,
                    'carbs' => 22,
                    'fats' => 28,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 3
                ],
                [
                    'name' => 'Asian Slaw Salad',
                    'description' => 'Shredded cabbage, carrots, green onions, sesame-ginger dressing.',
                    'calories' => 330,
                    'protein' => 6,
                    'carbs' => 28,
                    'fats' => 18,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 4
                ],
                // Breakfast
                [
                    'name' => 'Almond Butter Banana Toast',
                    'description' => 'Whole grain toast with almond butter and banana slices.',
                    'calories' => 320,
                    'protein' => 10,
                    'carbs' => 30,
                    'fats' => 18,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 3
                ],
                [
                    'name' => 'Vegan Breakfast Burrito',
                    'description' => 'Tofu scramble, black beans, and veggies in a whole wheat wrap.',
                    'calories' => 400,
                    'protein' => 18,
                    'carbs' => 42,
                    'fats' => 15,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 1,
                    'subscription_id' => 5
                ],

                // Lunch
                [
                    'name' => 'Chicken Fajita Bowl',
                    'description' => 'Sautéed chicken with peppers and onions over brown rice.',
                    'calories' => 520,
                    'protein' => 35,
                    'carbs' => 40,
                    'fats' => 20,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 1
                ],
                [
                    'name' => 'Lentil & Sweet Potato Curry',
                    'description' => 'Spiced lentils and sweet potatoes in a creamy coconut curry sauce.',
                    'calories' => 480,
                    'protein' => 19,
                    'carbs' => 50,
                    'fats' => 18,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 2,
                    'subscription_id' => 5
                ],

                // Dinner
                [
                    'name' => 'Turkey Meatballs & Zoodles',
                    'description' => 'Lean turkey meatballs served over zucchini noodles with tomato basil sauce.',
                    'calories' => 540,
                    'protein' => 35,
                    'carbs' => 18,
                    'fats' => 30,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Vegetable Coconut Stir Fry',
                    'description' => 'Mixed vegetables sautéed in coconut oil with tamari and garlic.',
                    'calories' => 460,
                    'protein' => 10,
                    'carbs' => 35,
                    'fats' => 28,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 3,
                    'subscription_id' => 4
                ],

                // Snacks
                [
                    'name' => 'Mixed Nuts & Berries',
                    'description' => 'Trail mix of almonds, cashews, dried cranberries, and blueberries.',
                    'calories' => 210,
                    'protein' => 6,
                    'carbs' => 20,
                    'fats' => 14,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 3
                ],
                [
                    'name' => 'Celery Sticks with Peanut Butter',
                    'description' => 'Crunchy celery served with natural peanut butter dip.',
                    'calories' => 160,
                    'protein' => 6,
                    'carbs' => 8,
                    'fats' => 12,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 4,
                    'subscription_id' => 4
                ],

                // Salads
                [
                    'name' => 'Spicy Chickpea Salad',
                    'description' => 'Roasted chickpeas with cucumbers, red onion, and tahini dressing.',
                    'calories' => 400,
                    'protein' => 14,
                    'carbs' => 30,
                    'fats' => 20,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 2
                ],
                [
                    'name' => 'Avocado & Tomato Salad',
                    'description' => 'Diced avocado, cherry tomatoes, red onion, and lime vinaigrette.',
                    'calories' => 350,
                    'protein' => 5,
                    'carbs' => 18,
                    'fats' => 28,
                    'image_url' => 'https://via.placeholder.com/150',
                    'category_id' => 5,
                    'subscription_id' => 1
                ]
            ]
        );
    }
}
