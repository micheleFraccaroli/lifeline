<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversations_user extends Model
{
	protected $fillable = [
        'id_utente', 'id_conversazione',
    ];
}