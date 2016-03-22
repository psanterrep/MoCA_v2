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
		// Matches The "/user/reloadUserInfo/{idType}" URL
		Route::get('/reloaduserinfo/{idType}', 'UserController@reloaduserinfo');
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
		Route::post('/save', 'FollowController@save');
		// Matches The "/follow/remove/{id}" URL
		Route::get('/remove/{id}', 'FollowController@remove');
	});

	// Consultation
    Route::get('/consultation', 'ConsultationController@index');
	Route::group(['prefix' => 'consultation'], function () {
		// Matches The "/consultation/add/{id}" URL
		Route::get('/add/{id}', 'ConsultationController@add');
		// Matches The "/consultation/save/{id}" URL
		Route::post('/save/{id}', 'ConsultationController@save');
		// Matches The "/consultation/edit/{id}" URL
		Route::get('/edit/{id}', 'ConsultationController@edit');
		// Matches The "/consultation/update/{id}" URL
		Route::post('/update/{id}', 'ConsultationController@update');
		// Matches The "/consultation/update/{id}" URL
		Route::get('/cancel/{id}', 'ConsultationController@cancel');
	});

	 // Test
    Route::get('/test', 'TestController@index');
	Route::group(['prefix' => 'test'], function () {
		// Matches The "/test/add/" URL
		Route::get('/add', 'TestController@add');
		// Matches The "/test/edit/{id}" URL
		Route::get('/edit/{id}', 'TestController@edit');
		// Matches The "/test/save/" URL
		Route::post('/save/{id}', 'TestController@save');
		// Matches The "/test/delete/{id}" URL
		Route::get('/delete/{id}', 'TestController@delete');
	});
});
