<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Entities\Plan;

class CheckSubscribtion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $plan=findById(Plan::class,1,[],['id','name']);
        // if(auth()->user()->subscribed($plan->name))
        // return $next($request);


        return redirect()->route('variouses.unsubscribtion');

    }
}
