<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use App\Friend;
use App\Post;
use App\User;
use App\Like;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $tot = array(Auth::user()->id);
        $array_id_usr = array();

        $frn = new Friend;
        $friends = $frn->getFriends(Auth::user()->id);
        foreach ($friends as $f) {
            array_push($array_id_usr, $f->id_utente);
        }
        $tot_friend = array_merge($tot, $array_id_usr);
        
        $pst = new Post;
        $lks = new Like;

        $totale = collect();
        foreach ($tot_friend as $t) {
            $posts = $pst->getPosts($t);
            $i=0;
            foreach($posts as $p) {
                //$users_like = $lks->getUserLike($p->id_post);
                $users_like = $lks->getLikeForPost($p->id_post);
                $p->tot_likes = count($users_like);
                foreach ($users_like as $ul) {
                    $ext = "id_like" . $i;
                    $p->$ext = $ul->id_utente;
                    $i++;   
                }
            }
            $totale = $totale->merge($posts);
        }
        
        return view('home', compact('totale'));
    } 
}