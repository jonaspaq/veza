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

    Route::get('email/verify', 'EmailVerificationController@resend')->name('verification.resend');
    Route::get('email/verify/{id}/{hash}', 'EmailVerificationController@verify')->name('verification.verify');
});

Route::group(['middleware' => ['auth:api', 'verified'], 'namespace' => 'Api'], function(){

    Route::group(['prefix' => 'user'], function() {
        Route::get('auth-details', 'UserController@authDetails');
        Route::get('{id}', 'UserController@show');
        Route::patch('{id}/edit', 'UserController@update');

        Route::patch('email/change', 'UserController@changeEmail');
        Route::patch('password/change', 'UserController@changePassword');
    });

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


