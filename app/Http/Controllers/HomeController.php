<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getgroups');
        $this->middleware('getpending');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = User::where('id', '=', Auth::id())->first();
        return view('home', compact('schedule'));
    }

    public function editClasses(){
        $schedule = User::where('id', '=', Auth::id())->first();
        return view('account.edit.classes', compact('schedule'));
    }

    public function editWork(){
        $schedule = User::find(Auth::id());
        return view('account.edit.work', compact('schedule'));
    }

    public function editClubs(){
        $schedule = User::find(Auth::id());
        return view('account.edit.clubs', compact('schedule'));
    }

    public function changeClasses(){
        $classes = "";
        for($i = 0; $i < count(request('days')); $i ++){
            for($j = 0; $j < count(request('days')[$i])-1; $j++){
                $classes .= request('days')[$i][$j].",";
            }
            $classes .= request('days')[$i][(count(request('days')[$i])-1)];
            $classes .= "/".request('starttime')[$i].",".request('endtime')[$i].",";
            $classes .= request('title')[$i].",".request('building')[$i].",".request('rooms')[$i].",".request('color')[$i];
            if($i < count(request('days'))-1){
                $classes .= "|";
            }
        }
        if(session('semester') == 'fall'){
            User::where('id', '=', Auth::id())->update(['fallclasses' => $classes]);
        }
        elseif(session('semester') == 'spring'){
            User::where('id', '=', Auth::id())->update(['springclasses' => $classes]);
        }
        

        $schedule = User::where('id', '=', Auth::id())->first();
        return view('home', compact('schedule'));
    }

    public function changeWork(){
        $work = "";
        for($i = 0; $i < count(request('days')); $i ++){
            for($j = 0; $j < count(request('days')[$i])-1; $j++){
                $work .= request('days')[$i][$j].",";
            }
            $work .= request('days')[$i][(count(request('days')[$i])-1)];
            $work .= "/".request('starttime')[$i].",".request('endtime')[$i];
            $work .= ",".request('color')[$i];
            if($i < count(request('days'))-1){
                $work .= "|";
            }
        }
        if(session('semester') == 'fall'){
            User::where('id', '=', Auth::id())->update(['fallwork' => $work]);
        }
        elseif(session('semester') == 'spring'){
            User::where('id', '=', Auth::id())->update(['springwork' => $work]);
        }

        $schedule = User::where('id', '=', Auth::id())->first();
        return view('home', compact('schedule'));
    }

    public function changeClubs(){
        $club = "";
        for($i = 0; $i < count(request('days')); $i ++){
            for($j = 0; $j < count(request('days')[$i])-1; $j++){
                $club .= request('days')[$i][$j].",";
            }
            $club .= request('days')[$i][(count(request('days')[$i])-1)];
            $club .= "/".request('name')[$i].','.request('starttime')[$i].",".request('endtime')[$i];
            $club .= ",".request('color')[$i];
            if($i < count(request('days'))-1){
                $club .= "|";
            }
        }
        if(session('semester') == 'fall'){
            User::where('id', '=', Auth::id())->update(['fallclubs' => $club]);
        }
        elseif(session('semester') == 'spring'){
            User::where('id', '=', Auth::id())->update(['springclubs' => $club]);
        }

        $schedule = User::where('id', '=', Auth::id())->first();
        return view('home', compact('schedule'));
    }

    public function changeSemester(){
        session(['semester' => request('semester')]);
        return back();
    }

    public function editUser(){
        return view('account.edit.user');
    }

    public function edit(){
        $emaillist = 0;
        if(request('emaillist') != null){
            $emaillist = 1;
        }
        User::find(Auth::id())->update(['name'=>request('name'), 'email'=>request('email'), 'emaillist'=>$emaillist]);

        return redirect(route('home'));
    }
}
