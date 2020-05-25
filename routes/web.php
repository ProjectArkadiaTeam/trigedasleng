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
// Home
Route::get('/', 'WebController@index')->name('home');

// Authentication
Route::post('/login', 'Web\\AuthController@login')->name('login');
Route::get('/profile', 'Web\\AuthController@profile')->name('profile');
Route::get('/signup', 'WebController@signup')->name('signup');
Route::post('/signup', 'Web\\AuthController@signup')->name('signup.submit');
Route::post('/signout', 'Web\\AuthController@logout')->name('signout');

// Words
Route::get('/word/{word}', 'WebController@wordLookup')->name('word.lookup');
Route::get('/word/{word}/edit', 'WebController@wordEdit')->name('word.edit');
Route::post('/word/{word}/edit', 'WebController@wordEditSubmit')->name('word.edit.submit');

// Admin
Route::get('/admin/add/word', 'WebController@addWord')->name('admin.word.add');
Route::post('/admin/add/word', 'WebController@addWordSubmit')->name('admin.word.add.submit');
Route::get('/admin/add/translation', 'WebController@addTranslation')->name('admin.translation.add');
Route::post('/admin/add/translation', 'WebController@addTranslationSubmit')->name('admin.translation.submit');

// Dictionary
Route::get('/dictionary/{dictionary?}', 'WebController@dictionaryLookup')->name('dictionary.lookup');

// Search
Route::get('/search', 'WebController@search')->name('search');
Route::get('/search/live', 'WebController@liveSearch')->name('search.live');

// Sources
Route::get('/sources', 'WebController@sources')->name('sources');

// Grammar
Route::get('/grammar', static function(){
    return view('grammar');
})->name('grammar');

// Translations
Route::get('/translations', 'WebController@translations')->name('translations');
