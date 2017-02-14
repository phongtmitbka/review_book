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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin', 'AccountController', ['except' => 'show']);
Route::get('logout', 'AccountController@getLogout');

Route::group(['prefix' => 'admin', 'middleware' => 'admin_login'], function () {
	Route::resource('book', 'BookController' );
	Route::resource('cate', 'CateController' );
	Route::resource('user', 'UserController');
	Route::resource('review', 'ReviewController');
	Route::resource('request', 'RequestController');
	Route::resource('comment', 'CommentController');
	Route::resource('changepass', 'AccountController');
});
