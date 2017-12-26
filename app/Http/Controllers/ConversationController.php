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
        if($request->ajax()) {
            $conv = Conversation::create([
                'tipo' => $request['type_conversation']
            ]);
            return response($conv);
        }
        return redirect('/users');
    }
}