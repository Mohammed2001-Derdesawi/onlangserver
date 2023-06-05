<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Course\Entities\Various;

class Authenticate extends Middleware
{


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Route::is('user.showLecture')){
            $lecture = findById(Lecture::class, $request->id , [] , ['id' , 'type']);
             if($lecture->type == 0){
                 return $request;
             }

            }
     
            
            
            
        if (! $request->expectsJson()) {
            return route('login');
 }
}
}