<?php

// 3. Chat Controller (app/Http/Controllers/ChatController.php)
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Барлық пайдаланушыларды алу
    public function getAllUsers()
    {
        $users = User::where('id', '!=', Auth::id())
            ->select('id', 'name', 'email')
            ->get();

        return response()->json($users);
    }

    // Хабарлама жіберу
    public function sendMessage(Request $request, $friendId)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $friendId,
                'message' => $request->message
            ]);



            $message->load(['sender', 'receiver']);

            broadcast(new MessageSent($message))->toOthers();

            return response()->json([
                'id' => $message->id,
                'sender_id' => $message->sender_id,
                'receiver_id' => $message->receiver_id,
                'message' => $message->message,
                'created_at' => $message->created_at->toISOString(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Ошибка сервера',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }

    // Хабарламаларды алу
    public function getMessages($friendId)
    {
        $messages = Message::where(function($query) use ($friendId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $friendId);
        })->orWhere(function($query) use ($friendId) {
            $query->where('sender_id', $friendId)
                ->where('receiver_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function($message) {
                return [
                    'id' => $message->id,
                    'sender_id' => $message->sender_id,
                    'receiver_id' => $message->receiver_id,
                    'message' => $message->message,
                    'created_at' => $message->created_at->toISOString(),
                ];
            });

        // Mark messages as read
        Message::where('sender_id', $friendId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    // Ағымдағы пайдаланушы деректерін алу
    public function getCurrentUser()
    {
        return response()->json([
            'id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email
        ]);
    }
}
