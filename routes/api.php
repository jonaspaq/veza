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
    Route::post('register', 'UserController@store');
    Route::post('login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function(){

    Route::get('user/authDetails', 'UserController@authDetails');
    Route::get('user/{id}', 'UserController@show');

    Route::apiResources([
        'post' => 'PostController',
        'friend' => 'FriendListController'
    ]);

    Route::group(['prefix' => 'friends'], function() {
        Route::get('sent-requests', 'FriendListController@pendingSentRequests');
        Route::get('received-requests', 'FriendListController@pendingReceivedRequests');
        Route::get('request-count', 'FriendListController@pendingRequestCount');
        Route::get('suggestions', 'FriendListController@friendSuggestions');
    });

    Route::apiResources([
        'message-threads' => 'MessageThreadsController',
        'thread/message' => 'MessageController'
    ]);
    Route::get('thread/messages/{id}', 'MessageController@messages');

    Route::get('search/user', 'SearchController@searchUserSpecific');
});


