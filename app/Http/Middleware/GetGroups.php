<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Groups;

class GetGroups
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
        $groupids = explode(',', Auth::user()->groups);
        $groups = array();
        foreach($groupids as $group){
            $groups[] = Groups::where('id', '=', $group)->first();
        }
        if($groups[0] == null){
            $groups = null;
        }
        view()->share('groups', $groups);
        return $next($request);
    }
}
