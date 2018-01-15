<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use Auth;


class Friend extends Model
{
    protected $fillable = [
        'id_utente1', 'id_utente2', 'type',
    ];

    public static function getFriends($id) {
    	$a = array();
    	$b = array();

    	$up = DB::table('friends')->select('id_utente2 AS id_utente', 'type')->where('id_utente1', $id)->where('type', '<>', 2)->where('type', '<>', 3)->get()->toArray();

    	foreach ($up as $u) {
    		array_push($a, $u);
    	}
    	$down = DB::table('friends')->select('id_utente1 AS id_utente', 'type')->where('id_utente2', $id)->where('type', '<>', 2)->where('type', '<>', 3)->get();
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
        $res = "";

        if(!empty($friends)) {
            foreach ($friends as $f) {
                if($f->id_utente == $id_other) {
                    if($f->type==0) {
                        $res = "found";
                    }
                    elseif ($f->type==1) {
                        $res = "requested";
                    }
                    else {
                        $res = "not_found";
                    }
                    return $res;
                }
                else {
                    $res = "not_found";
                }
            }
            return $res;
        }
        else {
            return "not_found";
        }
    }
}
