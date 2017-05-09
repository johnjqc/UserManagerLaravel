<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Role;
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
		    $roles = Role::all();
        return View('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $user = new User;
      $idRole = $request->role;
      $role = Role::find($idRole);

      $user->name = $request->name;
      $user->email      = $request->email;
      $user->password   = bcrypt($request->password);

      // $newRole = new Role(['role_id' => 'idRole', 'user_id' => $user->id]);
      // $user->roles()->save($role);
      // $user->roles->
      // $user->detachAllRoles();
      // $user->attachRole($role);

      $user->save();
      $user = User::where('email', $request->email)->first();
      $user->roles()->save($role);

      return redirect('users')->with('message', 'Usuario Creado');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      $user = User::find($id);
      return view('user.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $user = User::findOrFail($id);
	    $roles = Role::all();

      return view('user.edit', compact('user'), compact('roles'));
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
      $user = User::findOrFail($id);
      $idRole = $request->role;

      $user->name = $request->name;
      $user->email      = $request->email;
      $user->password   = bcrypt($request->password);

      $user->save();
      $role = Role::find($idRole);
      $user->roles()->detach();
      $user->roles()->save($role);

      return redirect('users')->with('message', 'Usuario Actualizado');
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
    }
}
