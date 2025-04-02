<?php

namespace App\Http\Controllers;

use App\Models\MealSelection;
use App\Models\MealSchedule;
use Illuminate\Http\Request;


class MealSelectionController extends Controller
{

    public function confirmsDay(Request $request)
    {
        $request->validate([
            'meal_schedule_id' => 'required|exists:meal_schedules,id',
            'selected_meal_ids' => 'required|array', // array of meal_selection IDs
            'selected_meal_ids.*' => 'exists:meal_selections,id',
        ]);

        $mealSchedule = MealSchedule::findOrFail($request->meal_schedule_id);

        // ✅ Lock the schedule
        $mealSchedule->locked = true;
        $mealSchedule->save();

        // ✅ Mark selected meals
        MealSelection::where('meal_schedule_id', $mealSchedule->id)
            ->whereIn('id', $request->selected_meal_ids)
            ->update(['selected' => true]);

        // ✅ Optionally unselect the rest
        MealSelection::where('meal_schedule_id', $mealSchedule->id)
            ->whereNotIn('id', $request->selected_meal_ids)
            ->update(['selected' => false]);

        return response()->json([
            'message' => 'Meals confirmed and schedule locked successfully.',
            'locked_schedule' => $mealSchedule->id
        ]);
    }


    public function submitSelection(Request $request)
    {
        $validated = $request->validate([
            'meal_schedule_id' => 'required|exists:meal_schedules,id',
            'selections' => 'required|array',
            'selections.*.category_id' => 'required|exists:meal_categories,id',
            'selections.*.meal_id' => 'required|exists:meals,id',
        ]);

        $schedule = MealSchedule::findOrFail($validated['meal_schedule_id']);

        // Lock check
        if ($schedule->locked) {
            return response()->json(['message' => 'Meal selection is already locked.'], 403);
        }

        // Check if selection already made (any selected = true)
        $alreadyChosen = MealSelection::where('meal_schedule_id', $schedule->id)
            ->where('selected', true)
            ->exists();

        if ($alreadyChosen) {
            return response()->json(['message' => 'You have already submitted your selection.'], 409);
        }

        // Update selected meals
        foreach ($validated['selections'] as $item) {
            // First: reset all to false for this category
            MealSelection::where('meal_schedule_id', $schedule->id)
                ->where('category_id', $item['category_id'])
                ->update(['selected' => false]);

            // Then: set the selected one
            MealSelection::where('meal_schedule_id', $schedule->id)
                ->where('category_id', $item['category_id'])
                ->where('meal_id', $item['meal_id'])
                ->update(['selected' => true]);
        }

        return response()->json(['message' => 'Meal selection submitted successfully.']);
    }


    public function selectMeal(Request $request)
    {
        $validated = $request->validate([
            'meal_schedule_id' => 'required|exists:meal_schedules,id',
            'category_id' => 'required|exists:meal_categories,id',
            'meal_id' => 'required|exists:meals,id',
        ]);

        // Unselect all current options for that day + category
        MealSelection::where('meal_schedule_id', $validated['meal_schedule_id'])
            ->where('category_id', $validated['category_id'])
            ->update(['selected' => false]);

        // Set selected = true for the chosen one
        MealSelection::where('meal_schedule_id', $validated['meal_schedule_id'])
            ->where('category_id', $validated['category_id'])
            ->where('meal_id', $validated['meal_id'])
            ->update(['selected' => true]);

        return response()->json(['message' => 'Meal selected successfully.']);
    }
}
