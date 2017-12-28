<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use App\Friend;
use App\Post;
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
        $frn = new Friend;
        $friends = $frn->getFrineds(Auth::user()->id);
        //dd($friends);
        $pst = new Post;
        foreach ($friends as $f) {
            $posts = $pst->getPosts($f, Auth::user()->id);    
        }
        //dd($posts);
        return view('home', compact('posts'));
    } 
}