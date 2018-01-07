<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
	protected $fillable = [
        'group_id', 'user_id', 'body', 'photo',
    ];

	//ritorna tutti i posts appertenenti ad un gruppo

    public static function all_posts_group($id_group){

    	$Post_groups = DB::table('posts')->select('body')->where("group_id","=",$id_group)->get();

    	return $Post_groups;

    }

    public static function getPosts($id) {
    	$res = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('likes', 'posts.id', '=', 'likes.id_post')
            ->select(DB::raw('posts.id as id_post, posts.body, users.id, users.name, users.surname, count(likes.id_post) as tot_likes'))->where('posts.user_id', $id)->groupBy('posts.id')->orderBy('posts.updated_at', 'desc')->get();
    	return $res;
    }


    /***********Geme fatta il 28/12/2017*************/

    /*ricavo l'utente che ha pubblicato un determinato post*/

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    }

}