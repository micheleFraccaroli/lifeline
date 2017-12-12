<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public static function get_id($id)
    {
    	return DB::table('conversations_users')->select('id_conversazione')->where('id_utente',$id)->get();
    	//return DB::table('conversations')->where('id',$id)->value('id');
    }
}
