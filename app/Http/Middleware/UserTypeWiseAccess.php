<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserTypeWiseAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$userType)
    {
        $roles=array();
        foreach($userType as $type){$roles[$type]=$type;}
        if(isset($roles[auth()->user()->user_type]))
        {
            return $next($request);
        }
        return response()->json(['You do not have permission to access for this page.']);
    }
}
