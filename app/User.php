<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'complete_name', 'email', 'sex', 'born', 'job', 'relation', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function get_contact($id) {
        return DB::table('users')->select('id', 'name', 'surname')->where('id', '<>', $id)->get();
    }

    public function posts(){

        return $this->hasMany('App\Post')->orderBy('created_at','desc');

    }



























    /*****Geme 03/01/2018*****/
    /*Ritorna tutti i gruppi a cui un utente è iscritto*/

    public function groups(){

        return $this->belongsToMany('App\Group');
    }
}
