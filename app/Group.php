<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

		/*ritorna tutti i post appartenenti ad un gruppo*/

	   public function posts(){

	   		return $this->hasMany('App\Post')->orderBy('created_at','desc');

	   } 

	   /*ritorno tutti gli utenti iscritti al gruppo*/

	   public function users(){

	   		return $this->belongsToMany('App\User');
	   }

	   /*ritorno l'utente admin del gruppo*/

	   public function user(){

	   		return $this->belongsTo('App\User','admin');
	   }

}
