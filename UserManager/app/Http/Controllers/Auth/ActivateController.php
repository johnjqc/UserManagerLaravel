<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Activation;
use App\Model\User;
use App\Utilities\ActivationHelper;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class ActivateController extends Controller {

    use ActivationHelper;

    private static $userHomeRoute   = 'public.home';
    private static $adminHomeRoute   = 'public.home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public static function getUserHomeRoute() {
        return self::$userHomeRoute;
    }

    public static function getAdminHomeRoute() {
        return self::$adminHomeRoute;
    }

    public function activate($token) {

        $user           = Auth::user();
        $currentRoute   = Route::currentRouteName();

        $activation = Activation::where('token', $token)->get()
            ->where('user_id', $user->id)
            ->first();

        if (empty($activation)) {
            Log::info('Registered user attempted to activate with an invalid token: ' . $currentRoute . '. ', [$user]);
            return redirect()->route('public.home')
                ->with('status', 'danger')
                ->with('message', 'Token Invalido para activar suario');
        }

        $user->activated = true;
        $user->save();

        $allActivations = Activation::where('user_id', $user->id)->get();
        foreach ($allActivations as $anActivation) {
            $anActivation->delete();
        }

        Log::info('Registered user successfully activated. ' . $currentRoute . '. ', [$user]);

        return redirect()->route(self::getUserHomeRoute())
            ->with('status', 'success')
            ->with('message', 'Usuario activado');

    }

}
