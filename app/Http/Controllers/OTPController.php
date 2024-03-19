<?php

namespace App\Http\Controllers;

use Ichtrojan\Otp\Models\Otp as OtpModel;
use Ichtrojan\Otp\Otp as OtpService; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class OTPController extends Controller
{
    public function verify()
    {
        return view('otp.verify');
    }

    public function check(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
      

       $validate =  (new OtpService)->validate(Auth::user()->email, $request->token);

    
       if($validate->status == true)
       {
        Alert::success('Success', 'OTP berhasil dimasukkan!');

        return redirect()->route('home');
       }

    
        
       
    }

    public function resetOtp(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Generate and send OTP via email
        (new OtpService)->generate($user->email, 'numeric', 6, 15);

        Alert::success('Success', 'Token berhasil dikirim ulang!');
        return redirect()->route('otp.verify');
    }

    
}
