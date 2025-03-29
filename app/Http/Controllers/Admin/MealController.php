<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MealController extends Controller
{
    // GET /admin/meals
    public function index()
    {
        return Meal::with(['category', 'subscriptions'])->get(); // eager load category if relation exists
    }

    // GET /admin/meals/{id}
    public function show($id)
    {
        $meal = Meal::with(['category', 'subscriptions'])->findOrFail($id);
        return response()->json($meal);
    }

    // POST /admin/meals
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'calories' => 'sometimes|required|integer|min:0',
                'protein' => 'sometimes|required|integer|min:0',
                'carbs' => 'sometimes|required|integer|min:0',
                'fats' => 'sometimes|required|integer|min:0',
                'image_url' => 'nullable|url',
                'category_id' => 'nullable|exists:meal_categories,id',
                'subscription_id' => 'nullable|exists:subscriptions,id', // ✅ added this
            ]);


            $meal = Meal::create($validated);

            return response()->json([
                'message' => 'Meal created successfully.',
                'data' => $meal,
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

    // PUT or PATCH /admin/meals/{id}
    public function update(Request $request, $id)
    {
        try {
            $meal = Meal::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'calories' => 'sometimes|required|integer|min:0',
                'protein' => 'sometimes|required|integer|min:0',
                'carbs' => 'sometimes|required|integer|min:0',
                'fats' => 'sometimes|required|integer|min:0',
                'image_url' => 'nullable|url',
                'category_id' => 'nullable|exists:meal_categories,id',
                'subscription_id' => 'nullable|exists:subscriptions,id', // ✅ added this
            ]);


            $meal->update($validated);

            return response()->json([
                'message' => 'Meal updated successfully.',
                'data' => $meal,
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


    // DELETE /admin/meals/{id}
    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return response()->json(['message' => 'Meal deleted successfully']);
    }
}
