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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'TracksController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('artists', 'ArtistsController');
	Route::resource('tracks', 'TracksController');
	Route::post('apply/upload', 'TracksController@store');

	Route::get('tracks/{id}/add_queue', 'TracksController@add_queue');
});