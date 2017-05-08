<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckIsUserActivated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

      $user           = Auth::user();
      $currentRoute   = Route::currentRouteName();
      $routesAllowed  = [
          'activate/{token}',
          'activate',
          'activation',
          'exceeded',
          'authenticated.activate',
          'logout',
          'welcome',
          'login',
      ];

      if (!in_array($currentRoute, $routesAllowed)) {
          if ($user && $user->activated != 1) {
              Log::info('Non-activated user attempted to visit ' . $currentRoute . '. ', [$user]);
              return redirect()->route('public.home')
                  ->with([
                      'message' => 'Activation is required. ',
                      'status'  => 'danger'
                  ]);
          }
      }

      if (in_array($currentRoute, $routesAllowed)) {
          if ($user && $user->activated == 1) {
              Log::info('Activated user attempted to visit ' . $currentRoute . '. ', [$user]);
              // if ($user->isAdmin()) {
              //     return redirect('home');
              // }
              return redirect('public.home');
          }

          if (!$user) {
              Log::info('Non registered visit to ' . $currentRoute . '. ');
              return redirect()->route('/');
          }
      }

        return $next($request);

    }
}
