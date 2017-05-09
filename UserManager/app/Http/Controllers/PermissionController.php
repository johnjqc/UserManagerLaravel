<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Permission;
use Auth;

class PermissionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $permissions = Permission::all();
      return view('permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return View('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $permission = new Permission;

      $permission->name = $request->name;
      $permission->description = $request->description;

      $permission->save();

      return redirect('permissions')->with('message', 'Permiso Creado');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      $permission = Permission::find($id);
      return view('permission.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $permission = Permission::findOrFail($id);
      return view('permission.edit', compact('permission'));
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
      $permission = Permission::findOrFail($id);

      $permission->name = $request->name;
      $permission->description      = $request->description;

      $permission->save();

      return redirect('permissions')->with('message', 'Permiso Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      try {
        $permission        = Permission::findOrFail($id);
        $permission->delete();
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
      } catch (Exception $e) {
        return "Fatal error - ".$e->getMessage();
      }
    }
}
