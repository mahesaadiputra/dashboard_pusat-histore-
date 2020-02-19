@extends('auth')

@section('title')
    <title>otp</title>
    <head><script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script></head>
@endsection

@section('content')
<div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Hi Store Dashboard</b> Verification</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                {{-- {{ __('adminlte::adminlte.login_message') }} --}}
                Input OTP the Code sent to your Telegram
            </p>


              @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                <form  action="{{route('verify.otp')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" name="otpCode" class="form-control {{ $errors->has('otp') ? 'is-invalid' : '' }}" value="{{ old('otp') }}" placeholder="Kode OTP" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-laptop-code"></span>
                            </div>
                        </div>
                        @if ($errors->has('OTP'))
                            <div class="invalid-feedback">
                                {{ $errors->get('otp') }}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="captcha">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                {{ __('input') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
    
@endsection









