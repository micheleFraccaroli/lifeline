<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Conversations_user;
use App\User;

class MessageController extends Controller
{
    protected function create(Request $request) {

    	if($request->ajax()) {
    		$message = Message::create([
    			'body' => $request['mess'],
    			'id_conversazione' => $request['id_conv'],
    			'id_utente' => $request['id_user'],
	    	]);

            $id_receiver = Conversations_user::where('id_conversazione', $request['id_conv'])->where('id_utente', $request['id_user'])->get();
            $user_receiver = User::find($id_receiver[0]->id_utente);

            $message['name_receiver'] = $user_receiver->name . " " . $user_receiver->surname;
            return $message;
    	}
    }

    protected function show(Request $request) {
    	if($request->ajax()) {
    		return Message::where('id_conversazione', $request['id_conversazione'])->get();
    	}
    }
}
