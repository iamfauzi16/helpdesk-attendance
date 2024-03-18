@extends('layouts.otp')
@section('content')
@push('styles')
    <style>
        .wrap-resend {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 24px;

        }
        #card {
            top: 50%;
        }
    </style>
@endpush
@section('title', 'OTP Verification')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card" id="card">
            <div class="card-body">
                <h3 class="text-dark my-3">OTP</h3>
                <form method="post" action="{{ route('otp.check') }}">
                    @csrf
                    <div class="form-group">
                        <label for="enter OTP">Enter OTP</label>
                        <input type="text" class="form-control @error('token') is-invalid @enderror" id="token"
                            name="token"placeholder="Input your otp">
                        @error('token')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Verify OTP</button>
                    
                    
                </form>

                <form method="post" action="{{ route('otp.resend') }}">
                    @csrf
                    <div class="wrap-resend">
                        <div>
                            <p>Belum menerima OTP?</p> 

                        </div>
                        <div>
                            <button type="submit" class="btn btn-link">Resend OTP</button>

                        </div>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
</div>

   
@endsection
