<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifie;

class NotifieController extends Controller
{
    public function index() {
    	$notifies = Notifie::all();
    	return view('notifies', compact('notifies'));
    }

    public function show($id) {
    	$id_news = Notifie::find_notice($id);
    	return view('n',compact('id_news'));
    }
}
