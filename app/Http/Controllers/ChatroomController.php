<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;

class ChatroomController extends Controller
{
    // Create Chatroom
    public function create(Request $request)
    {
        $chatroom = Chatroom::create([
            'name' => $request->name,
            'max_members' => $request->max_members,
        ]);

        return response()->json($chatroom);
    }

    // List Chatrooms
    public function index()
    {
        return response()->json(Chatroom::all());
    }

    // Join Chatroom
    public function join(Request $request, $id)
    {
        $chatroom = Chatroom::findOrFail($id);
        $chatroom->users()->attach($request->user()->id);

        return response()->json(['message' => 'Joined successfully']);
    }

    // Leave Chatroom
    public function leave(Request $request, $id)
    {
        $chatroom = Chatroom::findOrFail($id);
        $chatroom->users()->detach($request->user()->id);

        return response()->json(['message' => 'Left successfully']);
    }
}

