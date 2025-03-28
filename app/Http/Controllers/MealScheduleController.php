<?php

namespace App\Http\Controllers;

use App\Models\MealSchedule;
use Illuminate\Http\Request;

class MealScheduleController extends Controller
{
    public function getSchedule($userId)
    {
        $schedule = MealSchedule::whereHas('userSubscription', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->with(['selections.meal', 'selections.category'])
        ->orderBy('date')
        ->get();

        return response()->json([
            'status' => true,
            'data' => $schedule
        ], 200);
    }
}
