<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Models\MealSchedule;
use App\Models\MealSelection;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Exceptions\IncompletePayment;

class UserSubscriptionController extends Controller
{
    
    public function storeWithAutoSchedule(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'payment_method' => 'required|string', // Stripe Payment Method ID
        ]);

        $user = User::findOrFail($request->user_id);

        // ❌ Prevent duplicate active subscriptions
        $existing = UserSubscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'User already has an active subscription.',
                'data' => $existing
            ], 409);
        }

        $subscriptionPlan = Subscription::findOrFail($request->subscription_id);

        // ✅ Create Stripe Customer if not already created
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
        }

        // ✅ Attach payment method
        $user->updateDefaultPaymentMethod($request->payment_method);

        try {
            // ✅ Create subscription directly via Stripe API (no local Cashier save)
            $stripe = $user->stripe();

            $stripeSub = $stripe->subscriptions->create([
                'customer' => $user->stripe_id,
                'items' => [
                    ['price' => $subscriptionPlan->stripe_price],
                ],
                'default_payment_method' => $request->payment_method,
                'expand' => ['latest_invoice.payment_intent'],
            ]);

            // ✅ Save in your custom user_subscriptions table
            $userSubscription = UserSubscription::create([
                'user_id' => $user->id,
                'subscription_id' => $subscriptionPlan->id,
                'start_date' => now()->toDateString(),
                'end_date' => now()->addDays($subscriptionPlan->duration_days)->toDateString(),
                'status' => 'active',
                'stripe_id' => $stripeSub->id,
                'stripe_price' => $subscriptionPlan->stripe_price,
                'stripe_product' => $subscriptionPlan->stripe_product ?? null,
                'quantity' => $stripeSub->items->data[0]->quantity ?? 1,
            ]);

            // 🔁 Auto-generate meal schedules
            $categories = MealCategory::all();

            for ($i = 0; $i < $subscriptionPlan->duration_days; $i++) {
                $scheduleDate = now()->addDays($i)->toDateString();

                $mealSchedule = MealSchedule::create([
                    'user_subscription_id' => $userSubscription->id,
                    'date' => $scheduleDate,
                    'locked' => false,
                ]);

                foreach ($categories as $category) {
                    $meals = Meal::where('subscription_id', $subscriptionPlan->id)
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
                'message' => 'Subscription created, payment successful, meals scheduled!',
                'data' => $userSubscription
            ], 201);

        } catch (IncompletePayment $exception) {
            return response()->json([
                'message' => 'Payment requires additional actions.',
                'payment_intent' => $exception->payment->client_secret,
            ], 402); // Payment Required
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Subscription failed.',
                'error' => $e->getMessage()
            ], 500);
        }
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
