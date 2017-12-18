<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public static function get_id($id)
    {
    	//Query per ottenere l'id conversazione associato agli utenti
		$conv_private=DB::table('conversations_users')->join('conversations','conversations_users.id_conversazione','=','conversations.id')->select('id_conversazione')->where('id_utente',$id)->where('tipo','0')->get()->toArray();
		
		if(sizeof($conv_private)==0)return null; //Se la query precedente ritorna un array vuoto
		
		//Ritorno il corpo e i mittenti dei messaggi associati ad una specifica conversazione
		return DB::table('messages')->select('body','id_utente')->where('id_conversazione',$conv_private[0]->id_conversazione)->get();
    }
}


/*	Commenti

	$conv_private contiene l'id della conversazione a cui sta partecipando l'utente loggato e l'utente cliccato. Siccome get() ritorna una collezione, per poterla utilizzare la trasformo in array con toArray(). Dato che il risultato è unico (un utente può partecipare ad una sola conversazione privata con un altro utente), uso la notazione vettoriale diretta 'array[0]->campo'. Nel caso sia necessario ciclare il risultato della query, basta usare il costrutto foreach, ad esempio 'foreach($conv_private as $cp){}', in questo modo va usata la variabile '$cp'.*/