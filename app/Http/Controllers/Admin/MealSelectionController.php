<?php

namespace App\Http\Controllers\Admin;

use App\Models\MealSelection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealSelectionController extends Controller
{
    public function index()
    {
        return MealSelection::with(['mealSchedule', 'category', 'meal'])->get();
    }

    public function show($id)
    {
        $selection = MealSelection::with(['mealSchedule', 'category', 'meal'])->findOrFail($id);
        return response()->json($selection);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'meal_schedule_id' => 'required|exists:meal_schedules,id',
                'category_id' => 'nullable|exists:meal_categories,id',
                'meal_id' => 'nullable|exists:meals,id',
            ]);

            $selection = MealSelection::create($validated);

            return response()->json([
                'message' => 'Meal selection created.',
                'data' => $selection,
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

    public function update(Request $request, $id)
    {
        try {
            $selection = MealSelection::findOrFail($id);

            $validated = $request->validate([
                'category_id' => 'nullable|exists:meal_categories,id',
                'meal_id' => 'nullable|exists:meals,id',
            ]);

            $selection->update($validated);

            return response()->json([
                'message' => 'Meal selection updated.',
                'data' => $selection,
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
}
