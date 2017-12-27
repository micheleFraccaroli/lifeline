<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;

class Friend extends Model
{
    public static function getFrineds($id) {
    	$a = array();
    	$b = array();

    	$up = DB::table('friends')->select('id_utente2')->where('id_utente1', $id)->get()->toArray();
    	//dd($up[0]->id_utente2);
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
}
