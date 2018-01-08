<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MessageController extends Controller
{
    protected function create(Request $request) {
    	return Message::create([

    	]);
    }
}
