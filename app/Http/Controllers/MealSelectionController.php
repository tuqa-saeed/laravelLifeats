<?php

namespace App\Http\Controllers;

use App\Models\MealSelection;
use App\Models\MealSchedule;
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

    /**
     * Select a meal for a specific date and user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @param  string  $date
     * @return \Illuminate\Http\Response
     */
    public function selectMealForDate(Request $request, $userId, $date)
    {
        // Check if the meal schedule exists for the given user and date
        $mealSchedule = MealSchedule::whereHas('userSubscription', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->where('date', $date)
        ->first();

        if (!$mealSchedule) {
            return response()->json([
                'status' => false,
                'message' => 'Meal schedule not found for this date.'
            ], 404);
        }

        // Check if meal selection is allowed based on the cutoff time (12 hours before)
        $cutoffTime = now()->subHours(12);
        if ($mealSchedule->date <= $cutoffTime) {
            return response()->json([
                'status' => false,
                'message' => 'Meal selection is locked after the cutoff time.'
            ], 400);
        }

        // Create the meal selection
        $mealSelection = MealSelection::create([
            'meal_schedule_id' => $mealSchedule->id,
            'category_id' => $request->category_id,
            'meal_id' => $request->meal_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Meal selected successfully.',
            'data' => $mealSelection
        ], 201);
    }
}
