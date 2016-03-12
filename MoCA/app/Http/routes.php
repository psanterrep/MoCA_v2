<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

	// User
	Route::get('/user', 'UserController@index');
    Route::group(['prefix' => 'user'], function () {
		// Matches The "/user/new" URL
		Route::get('/create', 'UserController@create');
		// Matches The "/user/save/{id}" URL
		Route::post('/save/{id}', 'UserController@save');
		// Matches The "/user/edit/{id}" URL
		Route::get('/edit/{id}', 'UserController@edit');
		// Matches The "/user/delete/{id}" URL
		Route::get('/delete/{id}', 'UserController@delete');
	});
});
