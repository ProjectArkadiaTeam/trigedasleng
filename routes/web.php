<?php

use Illuminate\Http\Request;
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
Route::post('/login', 'WebController@login')->name('login');
Route::get('/signup', 'WebController@signup')->name('signup');
Route::post('/signup', 'WebController@signupSubmit')->name('signup.submit');
Route::post('/signout', 'WebController@signout')->name('signout');

// Words

// Old Word Route
Route::get('/word', function(Request $request){
    if($request->has('q')){
        return redirect(\route('word.lookup', $request->query('q')), 302);
    }
    return redirect(\route('home'));
});
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
Route::get('/translation/{id}', 'WebController@translationLookup')->where('id', '[0-9]+')->name('translation.lookup');
Route::get('/translation/{id}/edit', 'WebController@translationEdit')->where('id','[0-9]+')->name('translation.edit');
Route::post('/translation/{id}/edit', 'WebController@translationEditSubmit')->where('id','[0-9]+')->name('translation.edit.submit');
Route::get('/translations', 'WebController@translations')->name('translations');
