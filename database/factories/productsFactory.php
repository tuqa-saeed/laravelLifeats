<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class productsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 200), // prices from 5 to 200
        ];
    }
}
