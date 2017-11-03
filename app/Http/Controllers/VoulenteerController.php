<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Voulenteer;

class VoulenteerController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getgroups');
    }


    public function addEvent($id){
    	return view('voulenteer.addEvent', compact('id'));
    }

    public function add(){
    	$days = request('dates');
        $dates = explode(',', request('dates'));
        $shifts = explode(',', request('numofshifts')) ;
    	$times = array();
    	$daytime = "";
    	for($i = 0; $i < count($dates); $i ++){
    		$daytime = "";
    		for($j = 0; $j < $shifts[$i]; $j ++){
    			$daytime .= request('start')[$i+$j].','.request('end')[$i+$j];
    			if($j < ($shifts[$i]-1)){
    				$daytime .= "/";
    			}
    		}
    		$times[] = $daytime;
    	}
    	
    	$times = implode('|', $times);

    	Voulenteer::create([
    		'group' => request('group'), 
    		'days' => $days, 
    		'times' => $times, 
    		'num' => request('number'),
    		'name' => request('name'), 
    		'description' => request('description'),
    	]);
    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "pending"]));
    }

    public function open($id){
        $event = Voulenteer::find($id);
        return view('voulenteer.openEvent', compact('event'));
    }
}
