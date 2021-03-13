<?php

namespace App\Http\Middleware;

class LoginVerification {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, \Closure $next)
    {   
        if (empty(session('activeUser'))) {
                 $urlPrev = $request->url();
                 $request->session()->put('urlPrev', $urlPrev);

                return redirect('/');
        } else {
            if (!empty(session('urlPrev'))) {
                 $getUrlPrev = $request->session()->get('urlPrev');
                 $request->session()->forget('urlPrev');

                return redirect($getUrlPrev);
            }else{
                return $next($request);
            }
        }
    }
    
}
