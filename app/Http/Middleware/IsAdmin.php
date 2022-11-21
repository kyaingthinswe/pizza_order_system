<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        //Login ဝင်ထားရင် register page & login page ကို ကာထား
        if(!empty(Auth::user())){
            if(url()->current() == route('loginPage') || url()->current() == route('registerPage')){
                return back()->with('masterStatus','You need to logout');
//                return back();
            }
            if(auth()->user()->role == 'user'){
                return abort(404);
            }
        }
        return $next($request);

    }

}
