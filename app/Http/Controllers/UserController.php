<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\ImageOptimizer\OptimizerChainFactory; //<- penso non serva
use App\User;

class UserController extends Controller
{
    public function index() {
    	$users = User::all();
    	return view('users', compact('users'));
    }

    public function show($id) {
    	$user = User::find($id);
    	return view('user.index', compact('user'));
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
            $path = $request->file('user_pic')->storeAs('storage/user_profile', $name); 
            $user_update->image = $path;
        }
        $user_update->save();

        return redirect()->action('UserController@show', ['id' => $user_update->id]);
    }
}
