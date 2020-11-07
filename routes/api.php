<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function(){
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Legacy API
    Route::prefix('legacy')->group(function () {
        Route::get('/dictionary', 'LegacyController@dictionary')->name('api.legacy.dictionary');
        Route::get('/search', 'LegacyController@search')->name('api.legacy.search');
        Route::get('/recent', 'LegacyController@recent')->name('api.legacy.recent');
        Route::get('/random', 'LegacyController@random')->name('api.legacy.random');
        Route::get('/translations', 'LegacyController@translations')->name('api.legacy.translations');
    });

});

Route::namespace('Api\v1')->prefix('v1')->group(function(){
    Route::get('/group', 'GroupController@list')->name('api.v1.groups');
    Route::get('/user/{id}', 'UserController@profile')->name('api.v1.users.profile');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        // Update User Profile
        Route::put('/user/{id}', 'UserController@update')->name('api.v1.update.user.profile');
    });

    // Authentication
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login')->name('api.v1.auth.login');
        Route::post('signup', 'AuthController@signup')->name('api.v1.auth.signup');

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout')->name('api.v1.auth.logout');
            Route::get('me', 'AuthController@user')->name('api.v1.auth.me');
        });
    });

});

//Route::namespace('Api')->group(function(){
////    Route::middleware('auth:api')->get('/user', function (Request $request) {
////        return $request->user();
////    });
//
//    Route::prefix('auth')->group(function () {
//        Route::post('login', 'AuthController@login');
//        Route::post('signup', 'AuthController@signup');
//
//        Route::group(['middleware' => 'auth:api'], function() {
//            Route::get('logout', 'AuthController@logout');
//            Route::get('user', 'AuthController@user');
//        });
//    });
//
//    // Legacy API
//    Route::prefix('legacy')->group(function () {
//        Route::get('/dictionary', 'LegacyController@dictionary')->name('api.legacy.dictionary');
//        Route::get('/translations', 'LegacyController@translations')->name('api.legacy.translations');
//        Route::get('/search', 'LegacyController@search')->name('api.legacy.search');
//        Route::get('/lookup', 'LegacyController@wordLookup')->name('api.legacy.lookup');
//        Route::get('/recent', 'LegacyController@recent')->name('api.legacy.recent');
//        Route::get('/random', 'LegacyController@random')->name('api.legacy.random');
//    });
//});
