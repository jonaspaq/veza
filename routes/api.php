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
    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function(){

    Route::get('/user/authenticatedUserDetails', 'UserController@show');

    Route::apiResource('post', 'PostController');

    Route::post('/addFriend/{id}', 'FriendListController@addFriend');
    Route::get('/friendRequestCount', 'FriendListController@requestCount');
    Route::get('/friendSuggestions', 'FriendListController@friendSuggestions');

});


