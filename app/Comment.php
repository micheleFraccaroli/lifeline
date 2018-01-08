<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    public static function get_Post($id) {
    	$post = DB::table('posts')->where('id', $id)->pluck('body');
    	return $post;
    }



    /*Individuo a quele utente appartiene ha pubblicato un determinato commento*/

    public function user(){

        return $this->belongsTo('App\User');
    }

}