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
        $this->middleware('getpending');
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
        $shift = "";
    	for($i = 0; $i < count($dates); $i ++){
    		$daytime = "";
    		for($j = 0; $j < $shifts[$i]; $j ++){
    			$daytime .= request('start')[$i+$j].','.request('end')[$i+$j];
    			if($j < ($shifts[$i]-1)){
    				$daytime .= "/";
                    $shift .= "/";
    			}
    		}
    		$times[] = $daytime;
            if($i < (count($dates)-1)){
                $shift .= "|";
            }
    	}
    	
    	$times = implode('|', $times);

    	Voulenteer::create([
    		'group' => request('group'), 
    		'days' => $days, 
    		'times' => $times, 
    		'number' => request('number'),
    		'name' => request('name'), 
    		'description' => request('description'),
            'voulenteers' => $shift,
            'creator' => Auth::id(),
    	]);
    	return redirect(route('groupHome', ['id' => request('group'), 'page' => "voulenteer"]));
    }

    public function open($id){
        $event = Voulenteer::find($id);
        return view('voulenteer.openEvent', compact('event'));
    }

    public function addVoulenteer(){
        $days = explode('|', request('voulenteers'));
        $shifts = array();
        foreach($days as $day){
            $shifts[] = explode('/', $day);
        }
        $remove = explode('|', request('remove'));
        $r = array();
        foreach($remove as $rem){
            $r[] = explode('/', $rem);
        }
        $db = Voulenteer::find(request('id'))->voulenteers;
        $d = explode('|', $db);
        $s = array();
        foreach($d as $day){
            $s[] = explode('/', $day);
        }
        for($i = 0; $i < count($s); $i ++){
            for($j = 0; $j < count($s[$i]); $j ++){
                if($r[$i][$j] != "" && $r[$i][$j] != " "){
                    $sarr = explode(',', $s[$i][$j]);
                    $x = array_search($r[$i][$j], $sarr);
                    unset($sarr[$x]);
                    $sarr = array_values($sarr);
                    $s[$i][$j] = implode(',', $sarr);
                }
                else{
                    if($s[$i][$j] != "" && $s[$i][$j] != " " && $shifts[$i][$j] != "" && $shifts[$i][$j] != " "){
                        $s[$i][$j] .= ",".$shifts[$i][$j];
                    }
                    else{
                        $s[$i][$j] .= $shifts[$i][$j];
                    }
                }
            }
        }
        for($i = 0; $i < count($s); $i ++){
            $s[$i] = implode('/', $s[$i]);
        }
        $s = implode('|', $s);
        Voulenteer::find(request('id'))->update(['voulenteers'=>$s]);
        return redirect(route('groupHome', ['id' => request('group'), 'page' => "voulenteer"]));
    }
}
