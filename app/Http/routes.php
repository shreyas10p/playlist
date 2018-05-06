<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
|*/

Route::get('/',array('uses' => 'HomeController@showLogIn'));
/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
|*/

Route::get('/signout', array('uses' => 'HomeController@doLogout'));
/*
|--------------------------------------------------------------------------
| Facebook Signin Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/auth/facebook', array('uses' => 'SocialAuthController@facebookAuth'));
Route::get('/auth/facebook/callback', array('uses' => 'SocialAuthController@facebookCallback'));
/*
|--------------------------------------------------------------------------
| Google Signin Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/auth/google', array('uses' => 'SocialAuthController@googleAuth'));
Route::get('/google/callback', array('uses' => 'SocialAuthController@googleCallback'));
/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
|
*/
Route::any('errorpage', function() {
	return View::make('errorPage');
});

Route::any('dashboard', function() {
	return View::make('dashboard');
})->middleware('auth');
/*
|--------------------------------------------------------------------------
| Playlist Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/playlist/user/{id}', array('uses' => 'PlaylistController@show'))->middleware('auth.api');
Route::post('/playlist/create',array('uses' => 'PlaylistController@createPlaylist'))->middleware('auth.api');
Route::post('/playlist/delete/{id}',array('uses' => 'PlaylistController@delete'))->middleware('auth.api');
Route::get('/playlist/id/{id}', array('uses' => 'PlaylistController@getPlaylist'))->middleware('auth.api');

/*
|--------------------------------------------------------------------------
| Song Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/song/playlist/{id}', array('uses' => 'SongController@getSongs'))->middleware('auth.api');
Route::get('/playlist/show/{id}',array('uses' => 'SongController@show'))->middleware('auth');
Route::post('/song/add',array('uses' => 'SongController@addSong'))->middleware('auth.api');
Route::post('/song/delete/{id}',array('uses' => 'SongController@delete'))->middleware('auth.api');
/*
|--------------------------------------------------------------------------
| Tag Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/tag/playlist/{id}', array('uses' => 'Tag@getPlaylist'))->middleware('auth.api');


