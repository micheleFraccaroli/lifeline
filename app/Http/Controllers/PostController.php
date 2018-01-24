<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Like;

class PostController extends Controller
{
    protected function create(Request $request) {
    	
        if($request->ajax()){

            $body = $request->input('body_post');
            $link = $request->input('link_post');
            $pic = $request->file('pic_post');

            /*verifico alemno che un campo in input sia presente, altrimenti segnalo l'obbligo della 
              presenza di almeno un campo*/

            if ($body || $link || $pic) {

                $post = new Post;

                $post->user_id = Auth::id();
                $post->group_id = NULL;

                if ($request->hasFile('pic_post')) {

                    $request->validate([
                        'pic_post' => 'bail|image|max:3072',
                    ]);
                    
                    $path = $request->file('pic_post')->store('public');

                    $url = Storage::url($path);

                    $post->photo = $url;

                }

                if($body){
                    $xss = str_contains($body, ['<','>']);
                    if($xss == false) {
                        $request->validate([
                            'body_post' => 'bail|string|max:255',
                        ]);

                        $post->body = $body;
                    }
                    else {
                        return redirect('/');
                    }
                }

                if($link){

                    $xss = str_contains($link, ['<','>']);
                    if($xss == false) {
                        $request->validate([
                            'link_post' => 'bail|string|max:255',
                        ]);

                        $post->link = $link;
                    }
                    else {
                        return redirect('/');
                    }
                }

                    $post->save();

                    $user = Auth::user();

            }else{

                $request->validate([
                    'body_post' => 'bail|required|string|max:255',
                ]);
            }
            
        }
    }

    public function show_comments(Request $request){

        if($request->ajax()){

            $id = $request->input('id');

            $last = $request->input('last');

            $user = array();

            if ($last==0) {

                $comments = Post::find($id)->comments;

                foreach ($comments as $comment) {

                    $user[] = Comment::find($comment->id)->user;

                }

            }else{

                $comments = Post::find($id)->comments()->where('id','>',$last)->get();

                foreach ($comments as $comment) {

                    $user[] = Comment::find($comment->id)->user;

                }

            }


            return Response()->json(['comments'=>$comments,'user'=>$user]);

        }

    }


    public function store_post_group(Request $request){

        if($request->ajax()){

            $body = $request->input('body_post');
            $link = $request->input('link_post');
            $pic = $request->file('pic_post');
            $group_id = $request->input('group_id');

            /*verifico alemno che un campo in input sia presente, altrimenti segnalo l'obbligo della 
              presenza di almeno un campo*/

            if ($body || $link || $pic) {

                $post = new Post;

                $post->user_id = Auth::id();

                if ($request->hasFile('pic_post')) {

                    $request->validate([
                        'pic_post' => 'bail|image|max:3072',
                    ]);
                    
                    $path = $request->file('pic_post')->store('public');

                    $url = Storage::url($path);

                    $post->photo = $url;

                }

                if($body){
                    $xss = str_contains($body, ['<','>']);
                    if($xss == false) {
                        $request->validate([
                            'body_post' => 'bail|string|max:255',
                        ]);

                        $post->body = $body;
                    }
                    else {
                        return redirect('/');
                    }
                }

                if($link){

                    $xss = str_contains($link, ['<','>']);
                    if($xss == false) {
                        $request->validate([
                            'link_post' => 'bail|string|max:255',
                        ]);

                        $post->link = $link;
                    }
                    else {
                        return redirect('/');
                    }
                }

                    $post->group_id = $group_id;

                    $post->save();

                    $user = Auth::user();

            }else{

                $request->validate([
                    'body_post' => 'bail|required|string|max:255',
                ]);
            }
        }
    }



    public function destroy($id,Request $request)
    {
        if($request->ajax()){
            POST::destroy($id);

            return Response()->json(['success'=>'eliminato']);

        }
    }


    public function show($id) {

        $user = Post::find($id)->user; 

        $post = Post::find($id);
        $post->name = $user->name;
        $post->surname = $user->surname;

        $like = POST::find($post->id)->likes->count();

        $result = LIKE::getLikeForPost($post->id)->where('id_utente',$user->id);

        if ($result->count()) {
                
            $my_like = 1;

        }else{

            $my_like = 0;
        }

        return view('post.post', compact('post','user','like','my_like'));
    }
}
