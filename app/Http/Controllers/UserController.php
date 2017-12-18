<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function update($id) {
        $user_update = User::find($id);

        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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

        $user_update->save();

        return redirect('/users/user_update->id');
    }

    public function pic($id) {
        $image = request('image')->getClientOriginalName();
        $filename = time().$image;

        $user_pic = User::find($id);
        $user_pic->image = $filename;

        dd($filename);

        $user_pic->save();

        return redirect('/user/user_pic->id');
    }
}
