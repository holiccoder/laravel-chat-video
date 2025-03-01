<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        event(new NewMessage($message));

        return response()->json(['status' => 'Message Sent!']);
    }
}
