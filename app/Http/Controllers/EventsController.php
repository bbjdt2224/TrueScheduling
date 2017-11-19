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
        if(request('date') == null){
            return redirect()->back()->withErrors(['Please add dates']);
        }
        elseif(request('time') == null){
            return redirect()->back()->withErrors(['Start time is empty']);
        }
        elseif(request('name') == null){
            return redirect()->back()->withErrors(['Name is empty']);
        }

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

    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "upcoming"]));
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

    public function delete($id, $group){
        Events::find($id)->delete();
        return redirect(route('groupHome', ['id' => request('group'), 'page' => "upcoming"]));
    }
}
