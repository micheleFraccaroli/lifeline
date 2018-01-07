<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;

class Like extends Model
{
    protected $fillable = [
    	'id_post', 'id_commento', 'id_utente',
    ];

    public static function getuserId($id) {
    	return DB::table('users')->select('id','name','surname')->where('id', $id)->get();
    }

    public static function getUserLike($id) {
    	return DB::table('likes')->join('users', 'likes.id_utente', '=', 'users.id')->select('users.id', 'users.name', 'users.surname')->where('id_post', $id)->get();
    }
}
