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

    // Follow
    Route::get('/follow', 'FollowController@index');
	Route::group(['prefix' => 'follow'], function () {
		// Matches The "/follow/add/" URL
		Route::get('/add/', 'FollowController@add');
		// Matches The "/follow/save/{id}" URL
		Route::post('/save/', 'FollowController@save');
		// Matches The "/follow/remove/{id}" URL
		Route::get('/remove/{id}', 'FollowController@remove');
	});

	// Consultation
    Route::get('/consultation', 'ConsultationController@index');
	Route::group(['prefix' => 'consultation'], function () {
		// Matches The "/consultation/add/" URL
		Route::get('/add/{id}', 'ConsultationController@add');
		// Matches The "/consultation/save/" URL
		Route::post('/save/{id}', 'ConsultationController@save');
	});
});
