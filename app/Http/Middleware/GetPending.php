<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use App\Groups;
use App\FutureEvents;
use App\Voulenteer;

class GetPending
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $unread = array();
        $groups = Auth::user()->groups;
        foreach(explode(',', $groups) as $group){
            $unread[$group] = 0;
            $events = FutureEvents::where('group', '=', $group)->get();
            foreach($events as $event){
                $responded = explode(',', $event->responded);
                if(!in_array(Auth::id(), $responded)){
                    $unread[$group]++;
                }  
            }
        }
        view()->share('unread', $unread);
        return $next($request);
    }
}
