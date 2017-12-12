<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;

class FriendController extends Controller
{
    public function index() {
    	$friends = Friend::all();
    	return view('friends', compact('friends'));
    }

    public function showFriend($id) {
    	$friend = Friend::query_friend($id);
    	return view('friend', compact('friend'));
    }
}
