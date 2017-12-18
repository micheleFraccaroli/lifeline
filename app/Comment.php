<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    public static function get_Post($id) {
    	$post = DB::table('posts')->where('id', $id)->pluck('body');
    	//dd($post);
    	return $post;
    }

    //ritorna tutti i commenti relativi ad un post presente in un gruppo

    public static function show_comments_post($id_post){

    	$Comments_post = DB::table('comments')->select('body')->where('id_post',$id_post)->get();
    	
    	return $Comment_post;
    }

}
