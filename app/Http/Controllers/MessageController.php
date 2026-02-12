<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function clientMessages()
    {
        $users = User::where('role', 'engineer')->get();
        return view('client.messages', compact('users'));
    }

    public function engineerMessages()
    {
        $users = User::where('role', 'client')->get();
        return view('engineer.messages', compact('users'));
    }

    public function getMessages($userId)
    {
        $messages = Message::where(function($q) use ($userId) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $userId);
        })->orWhere(function($q) use ($userId) {
            $q->where('sender_id', $userId)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return response()->json($message);
    }
}
