<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifie;
use App\User;
use App\Comment;

class NotifieController extends Controller
{
    public function index() {
    	$notifies = Notifie::all();
    	return view('notifies', compact('notifies'));
    }

    public function show($id) {
    	$id_news = Notifie::find_notice($id);
    	//dd();
    	
    	if($id_news['type'] == 'friend') {
    		$id = $id_news['id'];
    		$user = User::find($id);
    		return view('user',compact('user'));	
    	}
    	elseif ($id_news['type'] == 'post') {
    		$id = $id_news['id'];
    		$comment_post = Comment::get_Post($id);
    		return view('comment_post',compact('comment_post'));
    	}
    	/* 
    	.
    	.
    	.
    	.
    	*/
    }
}
