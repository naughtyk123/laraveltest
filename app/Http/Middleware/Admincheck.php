<?php

namespace App\Http\Middleware;

use App\Models\UserGroupMap;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admincheck
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
       

   
        if(Auth::user()){

            $group = UserGroupMap::where('user_id', '=',  Auth::user()->id)->first();
            if(Auth::user()->is_admin==1){

                return $next($request);
    
            }

            if(Auth::user()){

            return $next($request);

            }

            else{
                return route('/');
            }
        }
        {
            return route('/');
        }
    }
}
