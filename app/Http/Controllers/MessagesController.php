<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Messages;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getgroups');
        $this->middleware('getpending');
    }

    public function post(){
    	Messages::create([
    		'group' => request('group'),
    		'user' => request('id'),
    		'message' => request('message'),
    	]);
    	return back();
    }
}
