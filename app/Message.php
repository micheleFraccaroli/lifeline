<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'body', 'id_conversazione', 'id_utente',
    ];
}
