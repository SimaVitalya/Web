<?php

namespace App\Http\Controllers;

use App\Events\StoreMessageEvent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {

        return inertia('Message/Chat');
    }

    public function store(Request $request)
    {
        $message = $request->input('body');

        event(new StoreMessageEvent($message));

        return response()->json(['success' => true]);
    }
}
