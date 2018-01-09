<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Conversations_user extends Model
{
	protected $fillable = [
        'id_utente', 'id_conversazione',
    ];

    public static function find_conversation($id_utente, $id_other) {
        return DB::select("select id_conversazione from conversations_users as cu1 where exists (select 1 from conversations_users cu2 where cu1.id_utente='$id_utente' and cu2.id_utente='$id_other' and cu1.id_conversazione=cu2.id_conversazione)");
    }
}