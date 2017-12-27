<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    protected function create(Request $request) {
    	if($request->ajax()) {
    		$post = Post::create([
	    		'id_user' => $request['your_id'],
	    		'body' => $request['body_post'],
	    		'photo' => $request['photo']
    		]);
    		return response($post);
    	}
    	return redirect('/home');
    }
}
