<?php

namespace App\Http\Controllers\Auth;

// use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo;
    public function redirectTo()
    {
        switch (Auth::user()->role) {

            case 2:
                $this->redirectTo = '/kasir';
                return $this->redirectTo;
                break;

            case 3:
                $this->redirectTo = '/pelayan';
                return $this->redirectTo;
                break;

            case 1:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
                break;

            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }

        // return $next($request);
    }

    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
}
