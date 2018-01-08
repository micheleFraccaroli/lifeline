<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use App\User;

class Like extends Model
{
    protected $fillable = [
    	'id_post', 'id_commento', 'id_utente',
    ];

    // public static function getUserLike($id) {
    // 	return DB::table('likes')->join('users', 'likes.id_utente', '=', 'users.id')->select('users.id', 'users.name', 'users.surname')->where('id_post', $id)->get();
    // }

    public static function getLikeForPost($id_post) {
    	$res = DB::table('likes')->select('id_post', 'id_utente')->where('id_post', $id_post)->get();
    	return $res;
    }
}