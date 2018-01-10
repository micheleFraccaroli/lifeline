<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    protected function create(Request $request) {
    	if($request->ajax()) {
    		return Message::create([
    			'body' => $request['mess'],
    			'id_conversazione' => $request['id_conv'],
    			'id_utente' => $request['id_user'],
	    	]);
    	}
    }

    protected function show(Request $request) {
    	if($request->ajax()) {
    		return Message::where('id_conversazione', $request['id_conversazione'])->get();
    	}
    }
}
