<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifie extends Model
{
    public static function find_notice($id) {
    	$query = DB::table('notifies')->select('from_request')->where('id', $id)->get();

    	foreach ($query as $q) {
    		dd($q);
    	}
	    	
    }
}
