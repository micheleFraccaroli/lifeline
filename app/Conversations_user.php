<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Conversations_user extends Model
{
	protected $fillable = [
        'id_utente', 'id_conversazione',
    ];

    public static function find_conversation($id_utente, $id_conversazione) {
    	$id_conv = DB::table('conversations_users')->select('id_conversazione')->where('id_utente', $id_utente)->get();

    	if($id_conv != null) {
    		foreach ($id_conv as $id) {
    			return DB::table('conversations_users')->select('id_utente', 'id_conversazione')->where('id_utente', $id_conversazione)->get();
    		}
		}
		else {
			return $id_conv;
		}
    }
}