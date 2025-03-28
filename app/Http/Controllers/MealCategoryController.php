<?php

namespace App\Http\Controllers;

use App\Models\MealCategory;
use Illuminate\Http\Request;

class MealCategoryController extends Controller
{
    public function getMealCategories()
    {
        $categories = MealCategory::all();

        return response()->json([
            'status' => true,
            'data' => $categories
        ], 200);
    }
}
