<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loggedInAdmin
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
//        dd($request->session()->get("user")->role_id==1);
        if($request->session()->has("user")  && $request->session()->get("user")->role_id==2){
            return $next($request);
        }
        else{
//            dd("ad");
           return redirect( "/home"); //403 code
        }
    }
}
