<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
      $email = $request->email;
      $password = $request->password;
      if (Auth::attempt(['email' => $email, 'password' => $password, 'activated' => 1])) {
          return redirect()->route('public.home');
      }
      return redirect()->route('public.home')
          ->with('message', 'Usuario no activo');
    }

    public function authenticate() {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'activated' => 1])) {
            // return redirect()->intended('dashboard');
        }
    }
}
