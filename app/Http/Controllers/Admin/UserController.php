<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /admin/users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // POST /admin/users
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required|in:user,admin,superadmin',

                // Optional fields
                'phone' => 'sometimes|string|max:20',
                'address' => 'sometimes|string|max:255',
                'preferences' => 'sometimes|string',
                'allergies' => 'sometimes|string',
            ]);

            $validated['password'] = bcrypt($validated['password']);
            $user = User::create($validated);

            return response()->json([
                'message' => 'User created successfully.',
                'data' => $user
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(), // returns detailed errors for each field
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unexpected server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // GET /admin/users/{id}
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        return response()->json($user);
    }

    // PUT/PATCH /admin/users/{id}
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found.'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $user->id,
                'password' => 'sometimes|min:6',
                'role' => 'sometimes|in:user,admin,superadmin',

                // Optional fields
                'phone' => 'sometimes|string|max:20',
                'address' => 'sometimes|string|max:255',
                'preferences' => 'sometimes|string',
                'allergies' => 'sometimes|string',
            ]);

            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            $user->update($validated);

            return response()->json([
                'message' => 'User updated successfully.',
                'data' => $user
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unexpected server error.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // DELETE /admin/users/{id}
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }

    // Optional: GET /admin/users/create and /edit aren't needed in API
}
