<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifie extends Model
{
    protected $fillable = [
    	'body', 'type', 'from_request', 'from_comment', 'from_post', 'from_like', 'id_utente',
    ];
}
