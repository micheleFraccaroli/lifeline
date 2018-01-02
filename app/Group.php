<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

		/*ritorna tutti i post appartenenti ad un gruppo*/

	   public function posts(){

	   		return $this->hasMany('App\Post')->orderBy('created_at','desc');

	   } 

}
