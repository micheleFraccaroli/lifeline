<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    protected function create(Request $request) {
    	if($request->ajax()) {
    		$post = Post::create([
	    		'user_id' => $request['your_id'],
	    		'body' => $request['body_post'],
	    		'photo' => '0'
    		]);
    		return response($post);
    	}
    	return redirect('/home');
    }

    public function show_comments(Request $request){

        if($request->ajax()){

            $id = $request->input('id');

            $last = $request->input('last');

            $user = array();

            $comments = Post::find($id)->comments;

            if ($last==0) {

                foreach ($comments as $comment) {

                    $user[] = Comment::find($comment->id)->user;

                }

            }else{


                $comments = Post::find($id)->comments->where('id','>',$last);

                foreach ($comments as $comment) {

                    $user[] = Comment::find($comment->id)->user;

                }

            }

            return Response()->json(['comments'=>$comments,'user'=>$user]);

        }

    }


    public function store_post_group(Request $request){

        if($request->ajax()){

            $post = new Post;

            $group_id = $request->input('group_id');
            $body = $request->input('body_post_group');

            $post->user_id = Auth::id();
            $post->group_id = $group_id;
            $post->body = $body;

            if ($request->hasFile('post_pic_group')) {
                
                $path = $request->file('post_pic_group')->store('public');

                $url = Storage::url($path);

                $asset = asset($url);

                $post->photo = $url;

            }else{

                $asset = "";
            }

                $post->save();

                $user = Auth::user();
            
                return Response()->json(['post'=>$post,'user'=>$user,'asset'=>$asset]);

        }

    }


    public function destroy($id,Request $request)
    {
        if($request->ajax()){

            POST::destroy($id);

            return Response()->json(['success'=>'eliminato']);

        }
    }
}