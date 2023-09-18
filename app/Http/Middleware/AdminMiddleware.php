<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'user' || Auth::user()->usertype == 'department_admin' ){
            return $next($request);
        }
        else{
            Auth::logout(); // user must logout before redirect them
            return redirect()->guest('login');
        }

    }
}
