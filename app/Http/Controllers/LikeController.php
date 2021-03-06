<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Notifications\LikeNotification;
use Auth;
use App\User;
use App\Like;
use App\Post;
use App\Group;

class LikeController extends Controller
{
    protected function createPostLike(Request $request) {
        if($request->ajax()) {
            $like = Like::create([
                'id_post' => $request['id_post'],
                'id_commento' => null,
                'id_utente' => Auth::id(),
            ]);
            
            $user = User::find(Auth::id());
            $news = Post::find($request['id_post'])->user;
            $news->name = $user->name;
            $news->surname = $user->surname;
            $news->id_post = $request['id_post'];

            $group_id = Post::find($request['id_post']);
            if($group_id->group_id != null) {
                $group_name = Group::find($group_id->group_id);
                $news->group_name = $group_name->name;     
            }
            else {
                $news->group_name = null;
            }

            $news->notify(new LikeNotification());
            
            return response($news);
        }
    }

    protected function deletePostLike(Request $request) {
    	if($request->ajax()) {
    		return Like::where('id_post', $request['id_post'])->where('id_commento', null)->where('id_utente', Auth::id())->delete();
    	}
    }
}