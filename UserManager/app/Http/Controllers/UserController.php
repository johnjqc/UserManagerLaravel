<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $users = User::all();
      return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return View::make('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $user = new User;

      $user->name = Input::get('name');
      $user->email      = Input::get('email');
      $user->password   = Hash::make(Input::get('password'));

      $user->save();

      return Redirect::to('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);

      return view('user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('user.edit', compact('user'));
      // return View::make('user.edit', [ 'user' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::find($id);

      $user->name = Input::get('name');
      $user->email      = Input::get('email');
      $user->password   = Hash::make(Input::get('password'));

      $user->save();

      return Redirect::to('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      try {
        $currentUser = Auth::user();
        $user        = User::findOrFail($id);
        if ($user->id != $currentUser->id) {
              $user->delete();
        }
        $users = User::all();
        return view('user.index', compact('users'));
      } catch (Exception $e) {
        return "Fatal error - ".$e->getMessage();
      }
      // return view('user.index');
      // return Redirect::to('/users');
      // return redirect()->route('user.index');
    }
}
