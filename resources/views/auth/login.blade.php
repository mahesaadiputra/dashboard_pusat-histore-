@extends('layouts.auth')

@section('title')
    <title>Hi Store  Admin- Login</title>
    <head><script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script></head>
@endsection

@section('content')
<body>
    

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if (session('error'))
                    @alert(['type' => 'danger'])
                        {{ session('error') }}
                    @endalert
                @endif
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
                
                
                
                
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

          
          
        </div>
    </div>
    </body>
    <script type="text/javascript">
$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:'/historeadm/refresh_captcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
</script>
        
    
@endsection









