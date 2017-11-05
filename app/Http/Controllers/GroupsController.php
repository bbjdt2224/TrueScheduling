<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Groups;
use App\User;
use App\Events;
use App\FutureEvents;
use App\Voulenteer;
use App\Messages;

class GroupsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware('getgroups');
    }

    public function joinGroup(){
    	$error = null;
    	return view('group.joinGroup', compact('error'));
    }

    public function join(){
    	$group = Groups::where('code', '=', request('group'))->first();
    	if($group == null){
    		$error = "This group number does not exist";
    		return view('group.joinGroup', compact('error'));
    	}
    	else{
    		$members = $group->groupmembers;
    		if($members == " "){
    			$members = Auth::id();
    		}
    		else{
    			if(in_array(Auth::id(), explode(',', $members))){
    				$error = "You already belong to this group";
    				return view('group.joinGroup', compact('error'));
    			}
    			else{
    				$members .= ",".Auth::id();
    			}
    			
    		}
    		$group->update(['groupmembers' => $members]);
    	}
    	$user = User::find(Auth::id())->groups;
    	if($user == 0){
    		$user = $group->id;
    	}
    	else{
    		$user .= ','.$group->id;
    	}
    	User::find(Auth::id())->update(['groups' => $user]);
    	return redirect(route('home'));
    }

    public function startGroup(){
    	return view('group.createGroup');
    }

    public function create(){
    	$open = 0;
    	if(request('open') == "yes"){
    		$open = 1;
    	}
    	$code = rand(10000,99999);
    	$id = Auth::id();
    	$group = Groups::create([
    		'lead' => Auth::id(),
    		'name' => request('groupname'),
    		'code' => $code,
    		'groupmembers' => $id,
    		'open' => $open,
    	]);

    	$usergroups = User::find(Auth::id())->groups;
    	if($usergroups == 0){
    		$usergroups = $group->id;
    	}
    	else{
    		$usergroups .= ",".$group->id;
    	}
    	User::find(Auth::id())->update(['groups' => $usergroups]);

    	return redirect(route('groupHome', ['id' => $group->id, 'page' => "upcoming"]));
    }

    public function showHome($id, $page){
        $day = date('l', time());
    	$events = Events::where('group', '=', $id)->get();
        $futureevents = FutureEvents::where('group', '=', $id)->get();
        $voulenteers = Voulenteer::where('group', '=', $id)->get();
        $messages = Messages::where('group', '=', $id)->get();
    	$group = Groups::find($id);
        $members = array();
        foreach(explode(',', $group->groupmembers) as $member){
            $members[] = User::find($member);
        }
    	return view('group.groupHome', compact('group', 'events', 'page', 'members','day', 'futureevents', 'voulenteers', 'messages'));
    }

    public function changeDay($id, $page){
        $day = request('day');
        $events = Events::where('group', '=', $id)->get();
        $futureevents = FutureEvents::where('group', '=', $id)->get();
        $group = Groups::find($id);
        $members = array();
        foreach(explode(',', $group->groupmembers) as $member){
            $members[] = User::find($member);
        }

        return view('group.groupHome', compact('group', 'events', 'page', 'members', 'day', 'futureevents'));
    }

}
