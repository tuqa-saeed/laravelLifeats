<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * List all available subscription plans.
     */
    public function index()
    {
        return response()->json(Subscription::all(), 200);
    }

    /**
     * Subscribe a user to a plan.
     */
    public function subscribeToPlan(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|exists:subscriptions,id',
        ]);

        // $user = Auth::user();

        // Check if the user already has an active subscription
        $activeSubscription = UserSubscription::where('user_id', 2)
            ->where('status', 'active')
            ->first();

        if ($activeSubscription) {
            return response()->json(['message' => 'You already have an active subscription.'], 400);
        }

        $subscription = Subscription::findOrFail($request->subscription_id);
        
        // Create user subscription
        $userSubscription = UserSubscription::create([
            'user_id' => 2,
            'subscription' => $subscription,
            'subscription_id' => $subscription->id,
            'start_date' => now(),
            'end_date' => now()->addDays($subscription->duration_days),
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'Subscription successful!',
            'subscription' => $userSubscription
        ], 201);
    }

    /**
     * Get current subscription status.
     */
    public function getSubscriptionStatus()
    {
        // $user = Auth::user();

        $subscription = UserSubscription::where('user_id', 2)
            ->where('status', 'active')
            ->with('subscription')
            ->first();

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found.'], 404);
        }

        return response()->json([
            'subscription' => $subscription->subscription->name,
            'status' => $subscription->status,
            'end_date' => $subscription->end_date,
        ], 200);
    }
}
