<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:15'],  
            'address' => ['nullable', 'string', 'max:255'],  
            'role' => ['nullable', 'string', 'max:50'],  
            'preferences' => ['nullable', 'string'],  
            'allergies' => ['nullable', 'string'], 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role ?? 'user',  
            'preferences' => $request->preferences,
            'allergies' => $request->allergies,
        ]);

        event(new Registered($user));
        return response()->json($user, 201);

    }
 /*    public function show()
{
    return response()->json(auth()->user()); 
}
 */
}
