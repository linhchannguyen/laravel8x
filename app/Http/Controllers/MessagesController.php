<?php

namespace App\Http\Controllers;

use App\Events\RedisEvent;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Messages::all();
        $users = User::all();
        return view('message.index', ['messages' => $messages, 'users' => $users]);
    }

    public function chat(Request $request)
    {
        $messages = Messages::create($request->all());
        broadcast(new RedisEvent($messages, Session::get('id')));

        return redirect()->back();
    }
}
