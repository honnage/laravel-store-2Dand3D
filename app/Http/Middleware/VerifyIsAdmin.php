<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if(Auth::user()->checkIsStatus() && Auth::check() && (Auth::user()->checkIsStatus() != 0 ) || (Auth::user()->id == 1 )){
            return $next($request);
        }
        return redirect("/login");

    }
}
