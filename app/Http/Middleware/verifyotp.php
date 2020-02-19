<?php

namespace App\Http\Middleware;

use Closure;

class verifyotp
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

        if (!$request->session()->exists('verify')) {
            // user value cannot be found in session
            return redirect()->route('otp');
        }


        return $next($request);
    }
}
