<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });

Auth::routes();

Route::group(['middleware' => 'web'], function() {
  Route::get('/', 'HomeController@index')->name('index');
  Route::get('/facebook', 'SocialAuthController@facebook');
  Route::get('/callback', 'SocialAuthController@callback');
  Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' =>'Auth\ActivateController@activate']);
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('index');
    Route::get('/home', ['as' => 'public.home',   'uses' => 'HomeController@index']);
});

Route::get('/users', 'UserController@index');
Route::resource('users', 'UserController');

Route::get('/roles', 'RoleController@index');
Route::resource('roles', 'RoleController');

Route::get('/permissions', 'PermissionController@index');
Route::resource('permissions', 'PermissionController');
