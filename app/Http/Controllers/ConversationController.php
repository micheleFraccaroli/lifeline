<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Conversation;
use App\Conversations_user;

class ConversationController extends Controller
{
    public function index()
    {
		$conversation=DB::table('users')->pluck('id');
		return view('conversations',compact('conversation'));
    }

    public function get_id($id)
    {
    	$conv=new Conversation();
    	$messages=$conv->get_id($id);
    	//$messages=Conversation::get_id($id);
    	return view('conversation',compact('messages'));
    }

    protected function create(Request $request) {
        if($request->ajax();

        $conversation = Conversation::create([
            'tipo' => $request['type']
        ]);

        //first your ID
        $conversations_users_1 = Conversations_user::create([
            'id_utente' => $request['id_log'],
            'id_conversazione' => $conversation->id
        ]);
        $conversations_users_2 = Conversations_user::create([
            'id_utente' => $request['id_other'],
            'id_conversazione' => $conversation->id
        ]);

        return Response()->json($conversation);
    }
}
