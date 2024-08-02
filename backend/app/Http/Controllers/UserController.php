<?php

namespace App\Http\Controllers;

use App\Events\OnlineStatus;
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

    public function userOnlineStatus(Request $request)
    {
        $request->validate([
            'is_online' => 'required|boolean'
        ]);
        $user = $request->user();
        $user->is_online = $request->is_online;
        $user->last_online_at = now();
        $user->save();
        broadcast(new OnlineStatus($user))->toOthers();
        return response()->json(['success' => true]);
    }
}
