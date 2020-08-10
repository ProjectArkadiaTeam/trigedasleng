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
        Route::get('/translations', 'LegacyController@translations')->name('api.legacy.translations');
        Route::get('/search', 'LegacyController@search')->name('api.legacy.search');
        Route::get('/lookup', 'LegacyController@wordLookup')->name('api.legacy.lookup');
        Route::get('/recent', 'LegacyController@recent')->name('api.legacy.recent');
        Route::get('/random', 'LegacyController@random')->name('api.legacy.random');
    });
});
