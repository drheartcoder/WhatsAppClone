<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Send Message
    public function sendMessage(Request $request, $chatroomId)
    {
        $message = Message::create([
            'chatroom_id' => $chatroomId,
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'attachment' => $request->file('attachment')?->store('attachments'),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }

    // List Messages
    public function listMessages($chatroomId)
    {
        $messages = Message::where('chatroom_id', $chatroomId)->get();
        return response()->json($messages);
    }
}

