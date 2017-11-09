<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events;
use App\FutureEvents;
use Auth;

class EventsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getgroups');
        $this->middleware('getpending');
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
            'creator' => Auth::id(),
    	]);

        if(request('future') == 1){
            FutureEvents::find(request('id'))->delete();
        }

    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "pending"]));
    }

    public function editEvent($id){
        $event = Events::find($id);
        return view('event.editEvent', compact('event'));
    }

    public function edit(){
        Events::find(request('id'))->update([
            'date'=>request('date'), 
            'name'=>request('name'),
            'starttime' => request('time'),
            'description' => request('description')
        ]);

        return redirect(route('groupHome', ['id' => request('group'), 'page' => "upcoming"]));
    }
}
