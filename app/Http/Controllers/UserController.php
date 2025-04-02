<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserProfile(Request $request)
    {
        return $request->user();
    }
    public function updateUserProfile(Request $request)
    {
        $user = auth()->user(); 
    
        $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'phone' => ['nullable', 'string', 'max:15'],
        'address' => ['nullable', 'string', 'max:255'],
        'preferences' => ['nullable', 'string'],
        'allergies' => ['nullable', 'string'],
        'role' => ['nullable', 'string', 'in:admin,user'],
        ]);
    
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'preferences' => $request->preferences,
            'allergies' => $request->allergies,
        ]);
       
        if ($request->has('role') && $user->role === 'admin') {
            $user->role = $request->role;
        }
        $user->save();
    
        return response()->json($user); 
    }
    


}

