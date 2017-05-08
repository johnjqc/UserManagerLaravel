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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/facebook', 'SocialAuthController@facebook');
Route::get('/callback', 'SocialAuthController@callback');

Route::get('/users', 'UserController@index');
Route::resource('users', 'UserController');

Route::get('/roles', 'RoleController@index');
Route::resource('roles', 'RoleController');

Route::get('/permissions', 'PermissionController@index');
Route::resource('permissions', 'PermissionController');
