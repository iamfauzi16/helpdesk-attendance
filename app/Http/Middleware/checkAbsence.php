<?php

namespace App\Http\Middleware;

use Closure;
use App\Attendance;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class checkAbsence
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
        $attendance = Attendance::where('user_id', Auth()->user()->id)->first();
        if(Auth::check() && $attendance) {
           return redirect()->route('create.attendance');
        }
        return $next($request);
       

        


    }       
}
