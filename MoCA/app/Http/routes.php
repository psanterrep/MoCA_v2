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
    return redirect('/home');
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
		// Matches The "/user/switchLang/{lang}" URL
		Route::get('/switchLang/{lang}', 'UserController@switchLang');
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
		// Matches The "/follow/showresults/{id}" URL
		Route::get('/showresults/{id}', 'FollowController@showresults');
		// Matches The "/follow/exportResults/{id}" URL
		Route::get('/exportResults/{id}', 'FollowController@exportResults');
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
		// Matches The "/consultation/activateSupervisedTest/{idConsultation}/{idTest}" URL
		Route::post('/activateSupervisedTest/{idConsultation}/{idTest}', 'ConsultationController@activateSupervisedTest');
		// Matches The "/consultation/takeTest/{idConsultation}/{idTest}" URL
		Route::get('/takeTest/{idConsultation}/{idTest}', 'ConsultationController@takeTest');
		// Matches The "/consultation/updateConsultationList" URL
		Route::post('/updateConsultationList', 'ConsultationController@updateConsultationList');
		// Matches The "/consultation/saveTestResult/{idConsultation}/{idTest}" URL
		Route::post('/saveTestResult/{idConsultation}/{idTest}', 'ConsultationController@saveTestResult');
		// Matches The "/consultation/update/{id}" URL
		Route::get('/cancel/{id}', 'ConsultationController@cancel');
		// Matches The "/consultation/showresults/{id}" URL
		Route::get('/showresults/{id}', 'ConsultationController@showresults');
		// Matches The "/consultation/exportResults/{id}" URL
		Route::get('/exportResults/{id}', 'ConsultationController@exportResults');
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
		// Matches The "/test/{idTest}" URL
		Route::get('/view/{idTest}', 'TestController@view');
	});
});
