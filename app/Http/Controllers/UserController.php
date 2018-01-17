<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\ImageOptimizer\OptimizerChainFactory; //<- penso non serva
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use App\Friend;
use Auth;
use App\Group_user;

class UserController extends Controller
{
    public function index() {
    	$users = User::all()->except(Auth::id());
    	return view('contacts', compact('users'));
    }

    public function show($id) {
        $user = collect();

        $usr = User::find($id);
        $user = $user->merge($usr);

        $frn = new Friend;
        $friends = $frn->getFriends($id); //<--potrebbe tornare utile
        $check = $frn->checkFriendship(Auth::id(), $id);
        $user = $user->merge($check);
        $type = $frn->checkTypeRequest(Auth::id());
        $user = $user->merge($type);

        $pst = new Post;
        $user_posts = $pst->getPosts($id);
        $user = $user->merge($user_posts);

        return view('user.index', compact('user'));
    }

    public function search(Request $request) {

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
}