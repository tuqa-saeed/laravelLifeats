<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\MealSchedule;
use App\Models\MealSelection;
use App\Models\Meal;
use App\Models\MealCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserSubscriptionController extends Controller
{
    public function storeWithAutoSchedule(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        // ✅ Check if the user already has an active subscription
        $existing = UserSubscription::where('user_id', $request->user_id)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'User already has an active subscription.',
                'data' => $existing
            ], 409); // 409 Conflict
        }

        $subscription = Subscription::findOrFail($request->subscription_id);

        // ✅ Create the user subscription
        $userSubscription = UserSubscription::create([
            'user_id' => $request->user_id,
            'subscription_id' => $subscription->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays($subscription->duration_days)->toDateString(),
            'status' => 'active',
        ]);

        // ✅ Generate meal schedules and selections
        $categories = MealCategory::all();

        for ($i = 0; $i < $subscription->duration_days; $i++) {
            $scheduleDate = now()->addDays($i)->toDateString();

            $mealSchedule = MealSchedule::create([
                'user_subscription_id' => $userSubscription->id,
                'date' => $scheduleDate,
                'locked' => false,
            ]);

            foreach ($categories as $category) {
                $meals = Meal::where('subscription_id', $subscription->id)
                    ->where('category_id', $category->id)
                    ->inRandomOrder()
                    ->take(3)
                    ->get();

                foreach ($meals as $meal) {
                    MealSelection::create([
                        'meal_schedule_id' => $mealSchedule->id,
                        'category_id' => $category->id,
                        'meal_id' => $meal->id,
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Subscription created and meal schedule generated!',
            'data' => $userSubscription
        ], 201);
    }

    public function getUserSchedule($user_id)
    {
        $subscription = \App\Models\UserSubscription::where('user_id', $user_id)
            ->where('status', 'active')
            ->latest()
            ->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found.'], 404);
        }

        $schedules = \App\Models\MealSchedule::where('user_subscription_id', $subscription->id)
            ->with(['selections.meal', 'selections.category'])
            ->orderBy('date')
            ->take(14) // 👈 LIMIT to 7 days
            ->get()
            ->map(function ($schedule) {
                return [
                    'id' => $schedule->id, // ← Add this line
                    'date' => $schedule->date,
                    'locked' => $schedule->locked,
                    'selections' => $schedule->selections->map(function ($sel) {
                        return [
                            'id' => $sel->id, // ← Also add this
                            'selected' => $sel->selected, // ✅ Add this line
                            'category' => $sel->category->name,
                            'meal' => [
                                'name' => $sel->meal->name,
                                'image_url' => $sel->meal->image_url,
                                'description' => $sel->meal->description,
                                'calories' => $sel->meal->calories,
                            ]
                        ];
                    })
                ];
            });


        return response()->json($schedules);
    }
}
