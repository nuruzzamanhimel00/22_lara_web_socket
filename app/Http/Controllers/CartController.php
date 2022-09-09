<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('carts');
    }

    public function fetchMessages(){
        $messages = Message::with(['user'])->get();
        if($messages){
            return response()->json([
                'status' => 'success',
                'data' => $messages
            ],200);
        }
    }
    public function sendMessages(Request $request){
        $sendMessg = Message::create([
            'user_id' =>   $request->user_id,
            'message' => $request->message
        ]);
        if($sendMessg){
            return response()->json([
                'status' => 'success',
                'data' => Message::find($sendMessg->id)->load('user')
            ],200);
        }

    }
}
