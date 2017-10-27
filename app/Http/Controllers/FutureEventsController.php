<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\FutureEvents;
use App\User;
use Auth;

class FutureEventsController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware('getgroups');
    }

    public function addEvent($id){
    	return view('future.addEvent', compact('id'));
    }

    public function add(){
    	$days = implode(',', request('date'));
    	$times = array();
    	for($i = 0; $i < count(request('start')); $i++){
    		$times[] = request('start')[$i].','.request('end')[$i];
    	}
    	$times = implode('|', $times);

    	FutureEvents::create([
    		'group' => request('group'), 
    		'days' => $days, 
    		'times' => $times, 
    		'name' => request('name'), 
    		'description' => request('description'),
    	]);
    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "pending"]));
    }

    public function openEvent($id){
    	$event = FutureEvents::find($id);
    	return view('future.openEvent', compact('event'));
    }

    public function save(){
        $dates = explode(',', request('dates'));
        $response = "";
        for($i = 0; $i < count($dates); $i ++){
            $response .= implode(',', request($dates[$i]));
            if($i < (count($dates)-1)){
                $response .= '/';
            }
        }
        if(FutureEvents::find(request('id'))->responded != null){
            $responded = FutureEvents::find(request('id'))->responded;
            $results = FutureEvents::find(request('id'))->results;
            $responded .= ','.Auth::id();
            $results .= $response;
            $fe = FutureEvents::find(request('id'))->update(['responded'=>$responded, 'results'=>$results]);
        }
        else{
            FutureEvents::find(request('id'))->update(['responded'=>Auth::id(), 'results'=>$response]);
        }
        return redirect(route('groupHome', ['id' => request('group'), 'page' => "pending"]));
    }
}
