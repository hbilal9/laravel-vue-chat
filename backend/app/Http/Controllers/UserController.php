<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'ilike', "%{$query}%")
                        ->where('id', '!=', $request->user()->id)
                        ->get();
        return response()->json($users);
    }
}
