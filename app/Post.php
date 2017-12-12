<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public static function all_post_group($id_group){

    	$Post_groups = DB::table('posts')->select('body')->where("id_group","=",$id_group)->get();

    	return $Post_groups;

    }
}
