<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {
    public function chat($userId){
        $me = Auth::id();
        $messages = Message::where(function($q) use($me,$userId){
            $q->where('sender_id',$me)->where('receiver_id',$userId);
        })->orWhere(function($q) use($me,$userId){
            $q->where('sender_id',$userId)->where('receiver_id',$me);
        })->orderBy('created_at')->get();

        return view('client.messages', compact('messages','userId'));
    }

    public function send(Request $req){
        $data = $req->validate([
            'receiver_id'=>'required|exists:users,id',
            'message'=>'required|string',
        ]);
        $data['sender_id'] = Auth::id();
        Message::create($data);
        return back();
    }
}