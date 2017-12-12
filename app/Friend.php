<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friend extends Model
{
    public static function query_friend($id) {

 	   	$query = Friend::where('id_utente1',$id)->pluck('id_utente2');
 	   	$query_2 = Friend::where('id_utente2',$id)->pluck('id_utente1');

 	   	$query = json_decode($query);
 	   	$query_2 = json_decode($query_2);

 	   	foreach ($query as $value) {
 	   		$friends[] = User::where('id',$value)->pluck('name');
 	   	}

 	   	return $friends;
    }
    
}