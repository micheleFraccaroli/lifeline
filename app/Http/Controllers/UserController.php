<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\ImageOptimizer\OptimizerChainFactory; //<- penso non serva
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use App\Friend;
use App\Like;
use Auth;
use App\Group_user;

class UserController extends Controller
{
    public function index() {
    	$users = User::all()->except(Auth::id());
    	return view('contacts', compact('users'));
    }

    public function show($id) {

        if (Auth::check() && (Auth::id()==$id)) {
            
            $user = collect();

            $usr = User::find($id);
            $user = $user->merge($usr);

            $all_posts = User::find($id)->posts;

            foreach ($all_posts as $post) {

                $user_io[$post->id] = POST::find($post->id)->user;
                $like[$post->id] = POST::find($post->id)->likes->count();

                $result = LIKE::getLikeForPost($post->id)->where('id_utente',Auth::id());

                if ($result->count()) {
                
                    $my_like[$post->id] = 1;

                }else{

                    $my_like[$post->id] = 0;
                }

            }

            return view('user.profile', compact('user','all_posts','user_io','my_like','like'));

        }elseif (Auth::check() && (Auth::id()!=$id)){

            $user = collect();

            $usr = User::find($id);
            $user = $user->merge($usr);

            $frn = new Friend;
            $friends = $frn->getFriends(Auth::id()); 
            $check = $frn->checkFriendship(Auth::id(), $id);
            $user = $user->merge($check);
            $type = $frn->checkTypeRequest(Auth::id());
            $user = $user->merge($type);

            /*Verifico se io e l'utente indicato siamo amici*/

            $all_requests = collect($friends);

            $only_friends = $all_requests->where('type',0);

            $my_friend = DB::table('users')->whereIn('id',$only_friends->pluck('id_utente'))->where('id',$id)->count();

            $all_posts = User::find($id)->posts;

            foreach ($all_posts as $post) {

                $user_io[$post->id] = POST::find($post->id)->user;
                $like[$post->id] = POST::find($post->id)->likes->count();

                $result = LIKE::getLikeForPost($post->id)->where('id_utente',Auth::id());

                if ($result->count()) {
                
                    $my_like[$post->id] = 1;

                }else{

                    $my_like[$post->id] = 0;
                }

            }

            return view('user.index', compact('user','all_posts','user_io','my_friend','my_like','like'));
        }else{

            return redirect('/');
        }
    }

    public function search(Request $request) {

        if(request('srch-term') == 'null') {
            $user = "Error";
            return view('users', compact('user'));
        }

        $search = request('srch-term');
        $user = User::where('complete_name', 'LIKE', '%'.$search.'%')->get();
        return view('users', compact('user'));

    }

    public function edit($id) {
    	$user_up = User::find($id);
        return view('user.edit', compact('user_up'));
    }

    public function update($id, Request $request) {
        $user_update = User::find($id);

        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'sex' => 'required|string|max:1',
            'born' => 'required|string|max:10',
            'job' => 'required|string|max:255',
            'relation' => 'required|string|max:255',
        ]);

        $user_update->name = request('name');
        $user_update->surname = request('surname');
        $user_update->email = request('email');
        $user_update->sex = request('sex');
        $user_update->born = request('born');
        $user_update->job = request('job');
        $user_update->relation = request('relation');

        if (request('user_pic') != null) {
            $name = $user_update->id . ".jpg";
            $path_public = $request->file('user_pic')->storeAs('public/user_profile', $name); 
            $path_real = "/storage/user_profile/" . $name;
            $user_update->image = $path_real;
        }
        $user_update->save();

        return redirect()->action('UserController@show', ['id' => $user_update->id]);
    }

    public function subscribe_new_group(Request $request,$id){

        
        if ($request->ajax()) {

            DB::table('group_user')->insert(
                ['group_id' => $id, 'user_id' => Auth::id()]
            );

        }else{

            DB::table('group_user')->insert(
                ['group_id' => $id, 'user_id' => Auth::id()]
            );

            return redirect('groups/index/'.$id);
        }

    }

    public function leave_group(Request $request,$id){

        DB::table('group_user')->where(['group_id' => $id, 'user_id' => Auth::id()])->delete();

        return redirect('groups/index/'.$id);

    }
    
    public function activity($id) {
        $user = User::find($id);
        return view('user.activity', compact('user'));
    }
}