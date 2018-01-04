<?php

namespace App\Http\Controllers;

use App\Notifications\FriendshipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifie;
use App\Friend;
use App\User;

class FriendController extends Controller
{
    protected function friendshipRequest(Request $request) {
    	$news = collect();

    	if($request->ajax()) {
    		$friendShip = Friend::create([
    			'id_utente1' => $request['my_id'],
    			'id_utente2' => $request['other_id'],
    			'type' => $request['type']
    		]);

    		$user = Friend::getDataNotification($request['my_id'], $request['other_id']);
    		//$user = User::find($request['my_id']);
    		$user->setAttribute('my_id', $request['my_id']);
    		
    		$user->notify(new FriendshipRequest());

    		return response($friendShip);
    	}
    }

    protected function friendshipRespond(Request $request) {
    	if($request->ajax()) {
    		$resp = Friend::where('id_utente1', $request['other_id'])->where('id_utente2', $request['my_id'])->update(['type' => $request['type']]);

    		return response($resp);
    	}
    }

    // protected function Deletefriendship(Request $request) {
    // 	if($request->ajax()) {
    // 		$del = Friend::where('id_utente1', $request['my_id'])->where('id_utente2', $request['other_id'])->update(['type' => $request['type']]);

    // 		return response($del);
    // 	}
    // }
}
