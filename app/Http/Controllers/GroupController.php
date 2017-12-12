<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Group;
use App\Post;

class GroupController extends Controller
{
    	public function index(){

		$gruppi = Group::all();
		return view('groups', compact('gruppi'));

		}

		public function group_details($id){

		$gruppo = Group::find($id);
		$posts_group = Post::all_post_group($id);
		return view('group', compact('gruppo','posts_group'));

		}

}
