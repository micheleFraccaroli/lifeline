<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifie;
use App\Friend;

class FriendController extends Controller
{
    protected function friendshipRequest(Request $request) {
    	if($request->ajax()) {
    		$friendShip = Friend::create([
    			'id_utente1' => $request['my_id'],
    			'id_utente2' => $request['other_id'],
    			'type' => $request['type']
    		]);

    		$news = new Notifie([
    			'body' => 'Hai una ' . $request['news'],
    			'type' => $request['news'],
    			'from_request' => $request['my_id'],
    			'from_comment' => '0',
    			'from_post' => '0',
    			'from_like' => '0',
    			'id_utente' => $request['other_id'],
    		]);
    		$news->save();

    		return response($friendShip);
    	}
    }

    protected function friendshipRequest_Delete(Request $request) {
    	if($request->ajax()) {
    		$del_friendShip = new Friend([
    			'id_utente1' => $request['my_id'],
    			'id_utente2' => $request['other_id'],
    			'type' => $request['type']
    		]);

    		$del_friendShip->save();
    		return response($del_friendShip);
    	}
    }
}
