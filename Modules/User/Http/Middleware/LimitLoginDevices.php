<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LimitLoginDevices
{

    public function handle($request, Closure $next)
    {
        // if (Auth::check()) {
        //     if (Auth::user()->sessions->count() >2 ) {
        //         Auth::logout();
        //         return redirect()->route('login')->with('error', 'You have reached the maximum number of allowed devices.');
        //     }
        // }

        return $next($request);
    }
}
