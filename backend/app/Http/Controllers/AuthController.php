<?php

namespace App\Http\Controllers;

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
}
