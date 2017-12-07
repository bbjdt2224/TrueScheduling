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
        $this->middleware('getpending');
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

    	return redirect(route('groupHome', ['id' => $group->id, 'page' => "message"]));
    }

    public function showHome($id, $page){
        $day = date('l', time());
    	$events = Events::where('group', '=', $id)->where('date', '>', date('Y-m-d', time()))->get();
        $futureevents = FutureEvents::where('group', '=', $id)->get();
        $voulenteers = Voulenteer::where('group', '=', $id)->get();
        $messages = Messages::where('group', '=', $id)->orderBy('created_at', 'desc')->get();
        $users = array();
        foreach($messages as $message){
            $user = User::find($message->user);
            $users[$user->id] = $user->name;
        }
    	$group = Groups::find($id);
        $members = array();
        foreach(explode(',', $group->groupmembers) as $member){
            $members[] = User::find($member);
        }
    	return view('group.groupHome', compact('group', 'events', 'page', 'members','day', 'futureevents', 'voulenteers', 'messages', 'users'));
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

    public function editGroup($id){
        $group = Groups::find($id);
        $members = array();
        foreach(explode(',', $group->groupmembers) as $member){
            $members[] = User::find($member);
        }
        return view('group.editGroup', compact('group', 'members'));
    }

    public function edit(){
        $open = 0;
        if(request('open') == "yes"){
            $open = 1;
        }
        Groups::find(request('id'))->update(['name'=>request('groupname'), 'open'=>$open]);

        return redirect(route('groupHome', ['id'=>request('id'), 'page'=>'message']));
    }

    public function delete($id){
        $group = Groups::find($id);
        foreach(explode(',', $group->groupmembers) as $member){
            $user = User::find($member);
            $groups = explode(',', $user->groups);
            $index = array_search($id, $groups);
            unset($groups[$index]);
            $groups = array_values($groups);
            $line = implode(',', $groups);
            $user->update(['groups'=>$line]);
        }
        $group->delete();

        return redirect(route('home'));
    }

    public function viewDeleted(){
        $deleted = Groups::onlyTrashed()->where('lead', '=', Auth::id())->get();
        return view('group.deleted', compact('deleted'));
    }

    public function revive($id){
        $group = Groups::withTrashed()->find($id);
        $group->restore();
        foreach(explode(',', $group->groupmembers) as $member){
            $user = User::find($member);
            $groups = $user->groups;
            $groups .= ','.$id;
            $user->update(['groups'=>$groups]);
        }

        return redirect(route('groupHome', ['id'=>$id, 'page'=>'message']));
    }

    public function leaveGroup($id){
        $members = explode(',',Groups::find($id)->groupmembers);
        $index = array_search(Auth::id(), $members);
        unset($members[$index]);
        $members = array_values($members);
        $members = implode(',', $members);
        Groups::find($id)->update(['groupmembers'=>$members]);

        $groups = explode(',',Auth::user()->groups);
        $index = array_search($id, $groups);
        unset($groups[$index]);
        $groups = array_values($groups);
        $groups = implode(',', $groups);
        User::find(Auth::id())->update(['groups'=>$groups]);

        return redirect(route('home'));
    }

}
