<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

use App\Comment;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            
            $comment = new Comment;

            $post_id = $request->input('post_id');
            $body = $request->input('body');

            $comment->user_id = Auth::id();
            $comment->post_id = $post_id;
            $comment->body = $body;
            $comment->save();
            $user = Auth::user();

            $news = Post::find($post_id)->user;
            $news->id_post = $post_id;
            $news->body_comment = $body;
            $news->notify(new CommentNotification());

            return Response()->json(['comment'=>$comment,'user'=>$user, 'news'=>$news]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
