<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

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




























    /********fatta da Geme il 29/12/2017*********/
    /********parte riguardante la visualizzazione dei commenti nei post dei gruppi*******/

    public function show_comments(Request $request){

        if($request->ajax()){

            $id = $request->input('id');

            $user = array();

            $comments = Post::find($id)->comments;

            foreach ($comments as $comment) {
                $user[] = Comment::find($comment->id)->user;
            }

            return Response()->json(['comments'=>$comments,'user'=>$user]);

        }

    }


    public function store_post_group(Request $request){

        if($request->ajax()){

            $post = new Post;

            $user_id = $request->input('user_id');
            $group_id = $request->input('group_id');
            $body = $request->input('body');

            $post->user_id = $user_id;
            $post->group_id = $group_id;
            $post->body = $body;

            if ($request->input('photo')!= "") {
                
                //do something...

            }else{

                $post->photo = 0;
            }

            $post->save();

            $user = Post::find($user_id)->user;
            
            return Response()->json(['post'=>$post,'user'=>$user]);

        }

    }
}
