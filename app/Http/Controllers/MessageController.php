<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function showMessages()
    {
        $user = Auth::user();
        return view('messages.messages', [
            'messages' => Message::all(),
            'user' => $user
        ]);
    }

    public function createMessage(Request $request)
    {
        $message = new Message();
        $message->body = $request->body;
        $message->title = $request->user()->name;
        $message->user_id = $request->user()->id;
        $message->save();

        return redirect('/messages');
    }

    public function getMessage($id)
    {
        $message = Message::find($id);
        return view('messages.edit', ['message' => $message]);
    }

    public function postEditMessage($id, Request $request)
    {
        $message = Message::find($id);
        $message->body = $request->body;
        $message->save();
        return redirect('/messages');
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/messages');
    }
}
