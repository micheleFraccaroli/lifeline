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

        $array = array_prepend($friends, ['id_utente'=>Auth::id(),'type' => 0]);

        $collection = collect($array)->where('type',0);

        $all_posts = DB::table('posts')->whereIn('user_id',$collection->pluck('id_utente'))->where('group_id',NULL)->orderBy('created_at', 'desc')->get();

        foreach ($all_posts as $post) {

            $user[$post->id] = POST::find($post->id)->user;
            $like[$post->id] = POST::find($post->id)->likes->count();

            $result = LIKE::getLikeForPost($post->id)->where('id_utente',Auth::id());

            if ($result->count()) {
                    
                $my_like[$post->id] = 1;

            }else{

                $my_like[$post->id] = 0;
            }

        }

        return view('home', compact('all_posts','user','like','my_like'));
        
    } 

    // public function updatePost(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     $tot = array(Auth::user()->id);
    //     $array_id_usr = array();

    //     $frn = new Friend;
    //     $friends = $frn->getFriends(Auth::user()->id);

    //     $array = array_prepend($friends, ['id_utente'=>Auth::id(),'type' => 0]);

    //     $collection = collect($array);

    //     $all_posts = DB::table('posts')->whereIn('user_id',$collection->pluck('id_utente'))->where('group_id',NULL)->where('id', '>', $request['id_last'])->orderBy('created_at', 'desc')->get();

    //     foreach ($all_posts as $post) {

    //         $user[$post->id] = POST::find($post->id)->user;
    //         $like[$post->id] = POST::find($post->id)->likes->count();

    //         $result = LIKE::getLikeForPost($post->id)->where('id_utente',Auth::id());

    //         if ($result->count()) {
                    
    //             $my_like[$post->id] = 1;

    //         }else{

    //             $my_like[$post->id] = 0;
    //         }

    //     }
    //     return response($all_posts);
    // } 
}