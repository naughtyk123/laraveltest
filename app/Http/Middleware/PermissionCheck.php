<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\CentralLogics\Uservalidation;
use App\Events\OnlineCheck;
use Illuminate\Support\Facades\Auth;

class PermissionCheck
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
        $result = Uservalidation::get_curent_url();
        if ($result) {
            // broadcast(new OnlineCheck(Auth::user()->id));
            return $next($request);
        } else {

           return redirect('dashboard');
        }
    }
}
