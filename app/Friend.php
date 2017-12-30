<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;

class Friend extends Model
{
    public static function getFriends($id) {
    	$a = array();
    	$b = array();

    	$up = DB::table('friends')->select('id_utente2')->where('id_utente1', $id)->get()->toArray();

    	foreach ($up as $u) {
    		array_push($a, $u->id_utente2);
    	}
    	$down = DB::table('friends')->select('id_utente1')->where('id_utente2', $id)->get();
    	foreach ($down as $d) {
    		array_push($b, $d->id_utente1);
    	}

    	$res = array_merge($a,$b);
    	return $res;
    }

    public static function checkFriendship($id_logged, $id_other) {
        $friends = self::getFriends($id_logged);

        foreach ($friends as $f) {
            if($f == $id_other) {
                return "find";
            }
        }
        return "not_find";
    }
}
