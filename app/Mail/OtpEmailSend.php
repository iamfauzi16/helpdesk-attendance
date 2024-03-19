<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;

use Ichtrojan\Otp\Models\Otp as OtpModel;
use Illuminate\Contracts\Queue\ShouldQueue;

class OtpEmailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = OtpModel::where('identifier', Auth::user()->email)->latest()->first(); 
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('emailOtp')
            ->with([
                'email' => $otp->identifier,
                'otpToken' => $otp->token
            ]);
    }
}
