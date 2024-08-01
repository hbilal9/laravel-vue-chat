<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $user = $request->user();

        // Create a new conversation
        $conversation = Conversation::create();
        
        // Attach both users to the conversation
        $conversation->users()->attach([$user->id, $request->user_id]);

        // Reload the conversation with the users excluding the logged-in user
        $conversation->load(['users' => function ($query) use ($user) {
            $query->where('users.id', '!=', $user->id);
        }]);

        return response()->json($conversation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
