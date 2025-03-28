<?php

namespace App\Http\Controllers\Admin;

use App\Models\MealCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MealCategoryController extends Controller
{
    // GET /admin/meal-categories
    public function index()
    {
        return MealCategory::all();
    }

    // GET /admin/meal-categories/{id}
    public function show($id)
    {
        $category = MealCategory::findOrFail($id);
        return response()->json($category);
    }

    // POST /admin/meal-categories
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|url',
            ]);

            $category = MealCategory::create($validated);

            return response()->json([
                'message' => 'Meal category created successfully.',
                'data' => $category
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unexpected server error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // PUT or PATCH /admin/meal-categories/{id}
    public function update(Request $request, $id)
    {
        try {
            $category = MealCategory::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'image' => 'nullable|url',
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Meal category updated successfully.',
                'data' => $category
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unexpected server error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // DELETE /admin/meal-categories/{id}
    public function destroy($id)
    {
        $category = MealCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Meal category deleted successfully.',
        ]);
    }
}
