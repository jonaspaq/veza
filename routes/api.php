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

Route::middleware('auth:api')->get('/userDetails', function (Request $request) {
    return $request->user();
});

Route::apiResource('user', 'Api\UserController');

Route::group(['middleware' => 'api'], function(){
    Route::post('user/register', 'Api\UserController@register');
    Route::post('user/login', 'Api\UserController@login')->name('login');
});

Route::group(['middleware' => 'auth:api'], function(){

    Route::apiResource('post', 'Api\PostController');

    Route::get('/friendSuggestions', 'Api\FriendListController@friendSuggestions');
    Route::post('/addFriend/{id}', 'Api\FriendListController@addFriend');

});


