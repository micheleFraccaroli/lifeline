<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
		$conversation=Conversation::all();
		return view('conversations',compact('conversation'));
    }

    public function get_id($id)
    {
    	$conv=new Conversation();
    	$messages=$conv->get_id($id);
    	//$messages=Conversation::get_id($id);
    	return view('conversation',compact('messages'));
    }
}
