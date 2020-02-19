<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use otp;
use Session;
use Auth;
use App\User;


class LoginController extends Controller
{








    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     *
     *
     *
     *
     */

public function logout(Request $request) {
   /* $user=User::where('id',Auth::user()->id)->first();
  $user->update(['status_login'=>0]);*/
    Auth::logout();
    Session::flush();
  return redirect('/login');
}



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
            $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
            
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password,  'status' => 1])) {
                               /* \Auth::logoutOtherDevices(request('password'));*/
                            $user=User::where('email',$request->email)->first();
                                            $otpTelegram = new otp;
                                            $otp=rand(1000,9999);
                                            $message = $otp." adalah kode OTP anda";
                                            $otpsend = $otpTelegram->sendMessageVia($user->id_telegram, $message,'Web Dashboard');
                                            Session::put(['otpkode'=>$otp]);

            return redirect()->route('otp');


                                                                                                            }
            return redirect()->back()->with(['error' => 'Password salah atau akun sedang di gunakan']);


    }


   /* public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

*/



}

