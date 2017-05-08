<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utilities\ActivationHelper;
use App\User;
use App\Model\Activation;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller {


		use ActivationHelper;

		public function facebook() {
        return Socialite::with('facebook')->redirect();
    }

    public function callback(SocialAccountService $service) {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
				$user = User::whereEmail($user->email)->first();
				$activationsCount = Activation::where('user_id', $user->id)->count();
				if ($activationsCount > 0) {
					return redirect()->route('login')->with('message', 'Tu usuario debe ser activado, revisa tu correo');
				}
				if ($user->activated == 1) {
					auth()->login($user);
					return redirect()->route('public.home');
				}
				$this->initiateEmailActivation($user);
        return redirect()->route('login')->with('message', 'Tu usuario se registro y debe ser activado, revisa tu correo');
    }
}
