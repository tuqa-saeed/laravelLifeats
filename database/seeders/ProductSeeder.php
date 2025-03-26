<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\products;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        products::factory()->count(15)->create();
    }
}
