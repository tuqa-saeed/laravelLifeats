<?php

namespace App\Http\Controllers;

use App\Models\MealSelection;
use Illuminate\Http\Request;

class MealSelectionController extends Controller
{
    public function index()
    {
        $mealSelections = MealSelection::all();
        return response()->json([
            'status' => true,
            'data' => $mealSelections
        ], 200);
    }

    public function show($id)
    {
        $mealSelection = MealSelection::find($id);
        if (!$mealSelection) {
            return response()->json([
                'status' => false,
                'message' => 'Meal selection not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $mealSelection
        ], 200);
    }

    /**
     * Create a new meal selection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'meal_schedule_id' => 'required|exists:meal_schedules,id',
            'category_id' => 'required|exists:meal_categories,id',
            'meal_id' => 'required|exists:meals,id',
        ]);

        $mealSelection = MealSelection::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Meal selection created successfully',
            'data' => $mealSelection
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mealSelection = MealSelection::find($id);
        if (!$mealSelection) {
            return response()->json([
                'status' => false,
                'message' => 'Meal selection not found'
            ], 404);
        }

        $mealSelection->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Meal selection updated successfully',
            'data' => $mealSelection
        ], 200);
    }

    public function destroy($id)
    {
        $mealSelection = MealSelection::find($id);
        if (!$mealSelection) {
            return response()->json([
                'status' => false,
                'message' => 'Meal selection not found'
            ], 404);
        }

        $mealSelection->delete();

        return response()->json([
            'status' => true,
            'message' => 'Meal selection deleted successfully'
        ], 200);
    }
}
