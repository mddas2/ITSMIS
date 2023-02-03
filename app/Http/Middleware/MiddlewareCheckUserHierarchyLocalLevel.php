<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserHierarchy;
use Illuminate\Http\Request;

class MiddlewareCheckUserHierarchyLocalLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = $request->user()->id;
        $hierarchy_id = 28;
        $user_local_level_hierarchy = UserHierarchy::where('user_id',$user_id)->where('hierarchy_id',$hierarchy_id)->get();
        if($user_local_level_hierarchy->count()>0){
            return $next($request);
        }

        return redirect('/')->with('permission_denied', 'You have not permission to Access Local Level hierarchy');
    }
}
