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

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function(){
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function(){

    Route::get('user/authenticatedUserDetails', 'UserController@show');

    Route::apiResource('post', 'PostController');
    
    Route::apiResource('friend', 'FriendListController');
    Route::patch('friends/accept', 'FriendListController@acceptRequest');
    Route::get('friends/sent-requests', 'FriendListController@pendingSentRequests');
    Route::get('friends/recieved-requests', 'FriendListController@pendingRecievedRequests');
    Route::get('friends/request-count', 'FriendListController@pendingRequestCount');
    Route::get('friends/suggestions', 'FriendListController@friendSuggestions');
});


