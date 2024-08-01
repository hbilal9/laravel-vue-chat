<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Conversation $conversation)
    {
        $messages = $conversation->messages()
            ->with('user:id,name,is_online,last_online_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Conversation $conversation)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $message = $conversation->messages()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($message);
    }

    public function markAsSeen(Message $message)
    {
        $message->update(['seen' => true, 'seen_at' => now()]);
        // broadcast(new MessageSeen($message))->toOthers();
        return response()->json(['success' => true]);
    }

    public function markAsDelivered(Message $message)
    {
        $message->update(['delivered' => true]);
        // broadcast(new MessageDelivered($message))->toOthers();
        return response()->json(['success' => true]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
