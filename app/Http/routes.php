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

Route::any('/', function () {
    return '';
});

// A group with API version prefix
Route::group(['prefix' => 'v' . env('APP_VERSION')], function () {
    // A group for authorized users
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/profile', 'ProfileController@index');
        Route::post('/search', 'SearchController@index');
        // Friends group
        Route::group(['prefix' => 'friend'], function () {
            Route::post('/all', 'FriendController@all');
            Route::post('/accept', 'FriendController@accept');
            Route::post('/decline', 'FriendController@decline');
            Route::post('/inbox', 'FriendController@inbox');
            Route::post('/outbox', 'FriendController@outbox');
            Route::post('/add', 'FriendController@add');
            Route::post('/remove', 'FriendController@remove');
        });
    });
    // Routes available for all users
    Route::post('/login', 'LoginController@index');
});