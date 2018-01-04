<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;

class Friend extends Model
{
    protected $fillable = [
        'id_utente1', 'id_utente2', 'type',
    ];

    public static function getFriends($id) {
    	$a = array();
    	$b = array();

    	$up = DB::table('friends')->select('id_utente2 AS id_utente', 'type')->where('id_utente1', $id)->get()->toArray();

    	foreach ($up as $u) {
    		array_push($a, $u);
    	}
    	$down = DB::table('friends')->select('id_utente1 AS id_utente', 'type')->where('id_utente2', $id)->get();
    	foreach ($down as $d) {
    		array_push($b, $d);
    	}

    	$res = array_merge($a,$b);
    	return $res;
    }

    public static function checkTypeRequest($id) {
        $a = collect();
        $res = DB::table('friends')->select('id_utente1 AS id_utente', 'type')->where('id_utente2', $id)->where('type',1)->get();
        if(count($res) == 0) {
            return 0;
        }
        return $res[0]->id_utente;
    }

    public static function checkFriendship($id_logged, $id_other) {
        $friends = self::getFriends($id_logged);

        foreach ($friends as $f) {
            if($f->id_utente == $id_other) {
                if($f->type==0) {
                    return "found";
                }
                elseif ($f->type==1) {
                    return "requested";
                }
                else {
                    return "not_found";
                }
            }
        }
        return "not_found";
    }

    public static function getDataNotification($my_id, $other_id) {
        $user = User::find($my_id);
        $user->id = $other_id;

        return $user;
    }
}
