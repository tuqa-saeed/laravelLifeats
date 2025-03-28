<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    // GET /admin/subscriptions
    public function index()
    {
        return Subscription::all();
    }

    // GET /admin/subscriptions/{id}
    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        return response()->json($subscription);
    }

    // POST /admin/subscriptions
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration_days' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
                'goal' => 'required|string|max:255',
                'active' => 'boolean',
            ]);

            $subscription = Subscription::create($validated);

            return response()->json([
                'message' => 'Subscription created successfully.',
                'data' => $subscription
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

    // PUT /admin/subscriptions/{id}
    public function update(Request $request, $id)
    {
        try {
            $subscription = Subscription::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'duration_days' => 'sometimes|required|integer|min:1',
                'price' => 'sometimes|required|numeric|min:0',
                'goal' => 'sometimes|required|string|max:255',
                'active' => 'boolean',
            ]);

            $subscription->update($validated);

            return response()->json([
                'message' => 'Subscription updated successfully.',
                'data' => $subscription
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

    // DELETE /admin/subscriptions/{id}
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return response()->json([
            'message' => 'Subscription deleted successfully.',
        ]);
    }
}
