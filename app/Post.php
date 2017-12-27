<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
	protected $fillable = [
        'id_user', 'body', 'photo',
    ];

	//ritorna tutti i posts appertenenti ad un gruppo

    public static function all_posts_group($id_group){

    	$Post_groups = DB::table('posts')->select('body')->where("id_group","=",$id_group)->get();

    	return $Post_groups;

    }

}