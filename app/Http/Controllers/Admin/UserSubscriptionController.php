<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserSubscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSubscriptionController extends Controller
{
    // GET /admin/user-subscriptions
    public function index()
    {
        return UserSubscription::with(['user', 'subscription'])->get();
    }

    // GET /admin/user-subscriptions/{id}
    public function show($id)
    {
        $userSub = UserSubscription::with(['user', 'subscription'])->findOrFail($id);
        return response()->json($userSub);
    }

    // POST /admin/user-subscriptions
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'subscription_id' => 'required|exists:subscriptions,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'status' => 'required|in:active,paused,cancelled',
            ]);

            $userSub = UserSubscription::create($validated);

            return response()->json([
                'message' => 'User subscription created successfully.',
                'data' => $userSub
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

    // PUT /admin/user-subscriptions/{id}
    public function update(Request $request, $id)
    {
        try {
            $userSub = UserSubscription::findOrFail($id);

            $validated = $request->validate([
                'start_date' => 'sometimes|required|date',
                'end_date' => 'sometimes|required|date|after_or_equal:start_date',
                'status' => 'sometimes|required|in:active,paused,cancelled',
            ]);

            $userSub->update($validated);

            return response()->json([
                'message' => 'User subscription updated successfully.',
                'data' => $userSub
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

    // DELETE /admin/user-subscriptions/{id}
    public function destroy($id)
    {
        $userSub = UserSubscription::findOrFail($id);
        $userSub->delete();

        return response()->json([
            'message' => 'User subscription deleted successfully.',
        ]);
    }
}
