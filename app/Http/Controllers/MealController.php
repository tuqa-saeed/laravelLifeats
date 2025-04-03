<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();

        return response()->json([
            'status' => true,
            'data' => $meals
        ], 200);
    }
    public function getMealsByCategory($categoryId)
    {
        $meals = Meal::where('category_id', $categoryId)->get();

        return response()->json([
            'status' => true,
            'data' => $meals
        ], 200);
    }

    public function getMealsByDate($date)
    {
        $meals = Meal::whereDate('created_at', $date)->get();

        return response()->json([
            'status' => true,
            'data' => $meals
        ], 200);
    }

    public function store(Request $request)
    {
        $meal = Meal::create($request->all());

        return response()->json([
            'status' => true,
            'data' => $meal
        ], 201);
    }

    public function show($id)
    {
        $meal = Meal::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $meal
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);
        $meal->update($request->all());

        return response()->json([
            'status' => true,
            'data' => $meal
        ], 200);
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return response()->json([
            'status' => true,
            'message' => 'Meal deleted successfully'
        ], 200);
    }
}
