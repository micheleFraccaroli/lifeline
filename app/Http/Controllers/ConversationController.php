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
        $c = new Conversation;
        $cu = new Conversations_user;

        if($request->ajax()) {
            $exist = $cu->find_conversation($request['user_log'], $request['id_other']);

            if(empty($exist[0]->id_conversazione)) {
                $conv = Conversation::create([
                    'tipo' => $request['type_conversation']
                ]);
                
                $id_conv = $c->get_identifier();   

                $conv_usr_my = new Conversations_user([
                    'id_utente' => $request['user_log'],
                    'id_conversazione' => $id_conv
                ]);

                $conv_usr_other = new Conversations_user([
                    'id_utente' => $request['id_other'],
                    'id_conversazione' => $id_conv
                ]);

                $conv_usr_my->save();
                $conv_usr_other->save();
                return response($id_conv);    
            }
            else {
                return response($exist[0]->id_conversazione);
            }
            
        }
        return redirect('/users');
    }
}