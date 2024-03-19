<?php

namespace App\Http\Middleware;

use Closure;
use Ichtrojan\Otp\Models\Otp as OtpModel;
use Ichtrojan\Otp\Otp; 
use Illuminate\Support\Facades\Auth;
class OtpValidate
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
     
        $otpModel = OtpModel::where('identifier', Auth::user()->email)->latest()->first();

       
        if($otpModel->valid == 0) {
            return $next($request);
        } elseif($otpModel->valid == 1) {
            return redirect()->route('otp.verify');

        } 



    }
}
