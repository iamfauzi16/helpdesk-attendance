<?php

namespace App\Http\Controllers\Auth;

use Ichtrojan\Otp\Otp;
use App\Mail\OtpEmailSend;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) 
    {
      
        (new Otp)->generate($user->email, 'numeric', 6, 60);

        Mail::to($user->email)->send(new OtpEmailSend());
        
        Alert::success('Success', 'Otp sudah dikirim, silahkan check email!');
        return redirect()->route('otp.verify');
    }

   
}
