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
    	return view('user.user', compact('user'));
    }

    public function update($id) {
    	$user_up = User::find($id);
        //dd($user->name);

        return view('user.index', compact('user_up'));
    }
}
