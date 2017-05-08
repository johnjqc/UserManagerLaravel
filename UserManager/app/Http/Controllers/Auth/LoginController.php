<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
      $email = $request->email;
      $password = $request->password;
      if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $user = User::whereEmail($email)->first();
        if ($user->activated != 1) {
          Auth::logout();
          return redirect()->route('login')
              ->with('message', 'Tu usuario debe ser activado, revisa tu correo');
        }
          return redirect()->route('public.home');
      }

      return redirect()->route('login')
          ->with('message', 'Usuario o contrase&ntilde;a invalidos');
    }

}
