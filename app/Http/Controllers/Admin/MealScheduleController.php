<?php
namespace App\Http\Controllers\Admin;

use App\Models\MealSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MealScheduleController extends Controller
{
    // GET /admin/meal-schedules
    public function index()
    {
        return MealSchedule::with(['userSubscription.user', 'selections.meal'])->get();
    }

    // GET /admin/meal-schedules/{id}
    public function show($id)
    {
        $schedule = MealSchedule::with(['userSubscription.user', 'selections.meal'])->findOrFail($id);
        return response()->json($schedule);
    }
}
