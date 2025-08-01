<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

//rony use start
use Illuminate\Support\Facades\Auth;
//rony use End

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //rony Admin login Multi Auth start
        if(Auth::guard('admin')){
           return $request->expectsJson() ? null : route('admin.login');
        }else{
           return $request->expectsJson() ? null : route('login');
        }
        //rony Admin login Multi Auth



        // User er Jonno by default chilo
        // return $request->expectsJson() ? null : route('login');
    }
}
