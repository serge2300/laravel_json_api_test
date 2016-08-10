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

// A group for authorized users
Route::group(['middleware' => 'auth'], function () {
    Routing::add('post', 'profile', ['user_id']);
    Routing::add('post', 'search', ['query']);
    // Friends group
    Route::group(['prefix' => 'friend'], function () {
        Routing::add('post', 'all');
        Routing::add('post', 'accept', ['user_id']);
        Routing::add('post', 'decline', ['user_id']);
        Routing::add('post', 'inbox');
        Routing::add('post', 'outbox');
        Routing::add('post', 'add', ['user_id']);
        Routing::add('post', 'remove', ['user_id']);
    });
});
// Routes available for all users
Routing::add('post', 'login', ['username', 'password']);