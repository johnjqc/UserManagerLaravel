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
// Route::post('login', array('uses' => 'HomeController@doLogin'));

Route::get('/', 'HomeController@index')->name('index');
Route::get('/facebook', 'SocialAuthController@facebook');
Route::get('/callback', 'SocialAuthController@callback');

Route::group(['middleware' => 'web'], function() {
    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
});

Route::group(['middleware' => ['auth', 'activated']], function() {
    Route::get('/home', ['as' => 'public.home',   'uses' => 'HomeController@index']);
});

//Route::get('auth/{driver}', ['as' => 'socialAuth', 'uses' => 'Auth\SocialController@redirectToProvider']);
//Route::get('auth/{driver}/callback', ['as' => 'socialAuthCallback', 'uses' => 'Auth\SocialController@handleProviderCallback']);
