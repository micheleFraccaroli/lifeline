<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\LikeNotification;
use Auth;
use App\User;
use App\Like;

class LikeController extends Controller
{
    protected function createPostLike(Request $request) {
    	if($request->ajax()) {
    		$like = Like::create([
    			'id_post' => $request['id_post'],
    			'id_commento' => null,
    			'id_utente' => $request['id_utente']
    		]);
    		/*
    		$news = Like::getUserId($request['id_utente']);
    		$news->setAttribute('id_post', $request['id_post']);
    		$news->notify(new LikeNotification());
			*/
    		return response($like);
    	}
    }
}
