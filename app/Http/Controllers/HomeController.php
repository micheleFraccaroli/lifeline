<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use App\Friend;
use App\Post;
use App\User;
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

        $frn = new Friend;
        $friends = $frn->getFriends(Auth::user()->id);
        $tot_friend = array_merge($tot, $friends);
        
        $pst = new Post;
        $totale = collect();
        foreach ($tot_friend as $t) {
            $posts = $pst->getPosts($t);
            $totale = $totale->merge($posts);
        }
        
        return view('home', compact('totale'));
    } 
}