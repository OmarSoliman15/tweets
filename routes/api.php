<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('tweets', 'TweetController')->except('update');
Route::post('users/{user}/follow', 'FollowingController@follow')->name('users.follow');
Route::post('users/{user}/unfollow', 'FollowingController@unfollow')->name('users.unfollow');
