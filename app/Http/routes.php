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

Route::resource('admin', 'AccountController', ['except' => 'show']);

Route::post('admin/checkLogin', ['as' => 'admin.checkLogin', 'uses' => 'AccountController@checkLogin']);

Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'AccountController@logout']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin_login'], function () {

    Route::resource('book', 'BookController' );

    Route::get('searchBook', ['as' => 'admin.searchBook', 'uses' => 'BookController@searchBook']);

    Route::resource('cate', 'CateController' );

    Route::get('searchCategory', ['as' => 'admin.searchCategory', 'uses' => 'CateController@searchCategory']);

    Route::resource('user', 'UserController');

    Route::get('searchUser', ['as' => 'admin.searchUser', 'uses' => 'UserController@searchUser']);

    Route::resource('review', 'ReviewController');

    Route::get('searchReview', ['as' => 'admin.searchReview', 'uses' => 'ReviewController@searchReview']);

    Route::resource('request', 'RequestController');

    Route::get('newRequest', ['as' => 'admin.newRequest', 'uses' => 'RequestController@newRequest']);

    Route::get('accept/{id}', ['as' => 'admin.accept', 'uses' => 'RequestController@accept']);

    Route::get('reject/{id}', ['as' => 'admin.reject', 'uses' => 'RequestController@reject']);

    Route::get('searchRequest', ['as' => 'admin.searchRequest', 'uses' => 'RequestController@searchRequest']);

    Route::get('searchNewRequest', ['as' => 'admin.searchNewRequest', 'uses' => 'RequestController@searchNewRequest']);

    Route::resource('comment', 'CommentController');

    Route::get('searchComment', ['as' => 'admin.searchComment', 'uses' => 'CommentController@searchComment']);

    Route::get('changePass', ['as' => 'admin.changePass', 'uses' => 'AccountController@showChangePass']);

    Route::post('changePass', ['as' => 'admin.changePass', 'uses' => 'AccountController@storeChangePass']);
});

Route::resource('user', 'AccountUserController', ['except' => 'show']);

Route::post('user/checkLogin', ['as' => 'user.checkLogin', 'uses' => 'AccountUserController@checkLogin']);

Route::get('user/logout', ['as' => 'user.logout', 'uses' => 'AccountUserController@logout']);
Route::get('/', ['as' => 'listReview', 'uses' => 'PagesController@index']);

Route::get('listReview', ['as' => 'listReview', 'uses' => 'PagesController@index']);

Route::get('listBook', ['as' => 'listBook', 'uses' => 'PagesController@showBook']);

Route::get('listReview', ['as' => 'listReview', 'uses' => 'PagesController@index']);

Route::get('reviewDetail/{id}', ['as' => 'reviewDetail', 'uses' => 'PagesController@showReviewDetail']);

Route::get('bookDetail/{id}', ['as' => 'bookDetail', 'uses' => 'PagesController@showBookDetail']);

Route::get('member/{id}', ['as' => 'member', 'uses' => 'PagesController@showMember']);

Route::get('reviewCate/{id}', ['as' => 'reviewCate', 'uses' => 'PagesController@showReviewCate']);

Route::get('searchReview', ['as' => 'searchReview', 'uses' => 'PagesController@searchReview']);

Route::get('searchBook', ['as' => 'searchBook', 'uses' => 'PagesController@searchBook']);

Route::get('searchMember', ['as' => 'searchMember', 'uses' => 'PagesController@searchMember']);

Route::get('bookCate/{id}', ['as' => 'bookCate', 'uses' => 'PagesController@showBookCate']);

Route::get('bookAuthor/{name}', ['as' => 'bookAuthor', 'uses' => 'PagesController@showBookAuthor']);

Route::get('reviewBook/{id}', ['as' => 'reviewBook', 'uses' => 'PagesController@showReviewBook']);

Route::group(['prefix' => 'user', 'middleware' => 'user_login'], function () {

    Route::resource('user', 'AccountUserController');

    Route::get('changePass', ['as' => 'user.changePass', 'uses' => 'AccountUserController@showChangePass']);

    Route::post('changePass', ['as' => 'user.ChangePass', 'uses' => 'AccountUserController@storeChangePass']);

    Route::get('review/{id}', ['as' => 'user.review', 'uses' => 'PagesController@showReview']);

    Route::post('review/{id}', ['as' => 'user.review', 'uses' => 'PagesController@storeReview']);

    Route::post('comment/{id}', ['as' => 'user.comment', 'uses' => 'PagesController@storeComment']);

    Route::get('home', ['as' => 'user.home', 'uses' => 'PagesController@showHome']);

    Route::post('newUserBook/{id}', ['as' => 'user.newUserBook', 'uses' => 'PagesController@createUserBook']);

    Route::post('vote/{id}', ['as' => 'user.vote', 'uses' => 'PagesController@vote']);

    Route::post('voteAgain/{id}', ['as' => 'user.voteAgain', 'uses' => 'PagesController@voteAgain']);

    Route::post('status/{id}', ['as' => 'user.status', 'uses' => 'PagesController@updateStatus']);

    Route::get('newFavorite/{id}', ['as' => 'user.newFavorite', 'uses' => 'PagesController@createFavorite']);

    Route::get('cancelFavorite/{id}', ['as' => 'user.cancelFavorite', 'uses' => 'PagesController@cancelFavorite']);

    Route::get('favorite/{id}', ['as' => 'user.favorite', 'uses' => 'PagesController@favorite']);

    Route::get('like/{id}', ['as' => 'user.like', 'uses' => 'PagesController@like']);

    Route::get('unlike/{id}', ['as' => 'user.unlike', 'uses' => 'PagesController@unLike']);

    Route::get('request', ['as' => 'user.request', 'uses' => 'PagesController@createRequest']);

    Route::post('request', ['as' => 'user.request', 'uses' => 'PagesController@storeRequest']);

    Route::get('bookRequest/{id}', ['as' => 'user.bookRequest', 'uses' => 'PagesController@showBookRequest']);

    Route::get('cancelRequest/{id}', ['as' => 'user.cancelRequest', 'uses' => 'PagesController@cancelRequest']);

    Route::get('follow/{id}', ['as' => 'user.follow', 'uses' => 'PagesController@follow']);

    Route::get('unFollow/{id}', ['as' => 'user.unFollow', 'uses' => 'PagesController@unFollow']);
});
