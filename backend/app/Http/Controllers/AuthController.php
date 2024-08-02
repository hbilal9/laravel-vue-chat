<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required'
       ]);

         if (!auth()->attempt($request->only('email', 'password'))) {
              return response()->json([
                'message' => 'Invalid login details'
              ], 401);
         }

        $user = $request->user();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'success' => true
        ]);
    }

    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Account created successfully',
            'success' => true
        ]);
    }

    public function getProfile(Request $request)
    {
        $user = $request->user();
        $user->is_online = true;
        $user->save();
        return $user;
    }
}
