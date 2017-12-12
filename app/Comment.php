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
}
