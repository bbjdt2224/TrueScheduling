<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events;
use App\FutureEvents;

class EventsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getgroups');
    }
	
    public function addEvent($id){
    	return view('event.addEvent', compact('id'));
    }

    public function add(){
    	Events::create([
    		'group' => request('group'),
    		'date' => request('date'),
    		'starttime' => request('time'),
    		'name' => request('name'),
    		'description' => request('description'),
    	]);

        if(request('future') == 1){
            FutureEvents::find(request('id'))->delete();
        }

    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "pending"]));
    }
}
