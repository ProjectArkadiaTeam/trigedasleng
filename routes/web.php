<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WebController@index')->name('home');
Route::post('/login', 'WebController@login')->name('login');
Route::get('/signup', 'WebController@signup')->name('signup');
Route::post('/signup', 'WebController@signupSubmit')->name('signup.submit');
Route::post('/signout', 'WebController@signout')->name('signout');
Route::get('/word/{word}', 'WebController@wordLookup')->name('word.lookup');
Route::get('/word/{word}/edit', 'WebController@wordEdit')->name('word.edit');
Route::post('/word/{word}/edit', 'WebController@wordEditSubmit')->name('word.edit.submit');
Route::get('/dictionary/{dictionary?}', 'WebController@dictionaryLookup')->name('dictionary.lookup');
Route::get('/sources', 'WebController@sources')->name('sources');
Route::get('/grammar', static function(){
    return view('grammar');
})->name('grammar');
Route::get('/translations', 'WebController@translations')->name('translations');
