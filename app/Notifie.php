<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifie extends Model
{
    public static function find_notice($id) {
    	$query = DB::table('notifies')->select('from_request','from_comment','from_post','from_like')
    				->where('id', $id)->get()->toArray();

		foreach ($query as $value) {
			if($value->from_request != NULL) {
				return $data = array('id' => $value->from_request, 'type' => 'friend');
			}
			elseif ($value->from_post != NULL) {
				return $data = array('id' => $value->from_post, 'type' => 'post');
			}
			elseif ($value->from_comment != NULL) {
				return $data = array('id' => $value->from_comment, 'type' => 'comment');
			}
			elseif ($value->from_like != NULL && $value->from_post != NULL) {
				return $data = array('id' => $value->from_post, 'type' => 'post');
			}
			elseif ($value->from_like != NULL && $value->from_comment != NULL) {
				return $data = array('id' => $value->from_comment, 'type' => 'comment');
			}
			elseif ($value->from_comment != NULL && $value->from_post != NULL) {
				return $data = array('id' => $value->from_post, 'type' => 'post');
			}
			else{
				dd("Errore testa di cazzo");
			}
		}
	}
}
