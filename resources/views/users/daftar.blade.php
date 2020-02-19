@extends('layouts.daftar')

@section('title')
    <title>Daftar</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
             @if (session('error'))
                    @alert(['type' => 'danger'])
                        {{ session('error') }}
                    @endalert
                @endif
            <form method="POST" action="{{ route('users.daftar') }}">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text"
                        name="name" 
                        class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" 
                        placeholder="{{ __('name') }}"
                        value="{{ old('name') }}">
                    <span class="fa fa-envelope form-control-feedback"> {{ $errors->first('name') }}</span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email"
                        name="email" 
                        class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                        placeholder="{{ __('E-Mail Address') }}"
                        value="{{ old('email') }}">
                    <span class="fa fa-envelope form-control-feedback"> {{ $errors->first('email') }}</span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" 
                        name="password"
                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} " 
                        placeholder="{{ __('Password') }}">
                    <span class="fa fa-lock form-control-feedback"> {{ $errors->first('password') }}</span>
                </div>
                <div class="form-group has-feedback">
                    <input type="hidden"
                        name="role" 
                        class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}" 
                        placeholder="{{ __('role') }}"
                        value="user">
                </div>
                    
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        <br>
                        <p class="mb-1">
                
            <p class="mb-0">
                <a href="/login" class="text-center">Login</a>
            </p>
                    </div>
                </div>
                
            </form>

            

            
        </div>
    </div>
@endsection