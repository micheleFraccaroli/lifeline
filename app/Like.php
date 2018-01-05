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
}
