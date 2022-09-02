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

Auth::routes();

Route::get('/', function(){
    return view('welcome');
});
Route::resource('films', 'FilmController');
Route::post('/add-comment', 'HomeController@addComment')->middleware('auth');
Route::get('get-comments','FilmController@getComments');

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){

    Route::middleware('guest:admin')->group(function(){    
        Route::get('/','AdminController@index')->name('login');
        Route::get('login','AdminController@index')->name('login');
        Route::post('login','AdminController@login')->name('login');
    });

    Route::middleware('adminauth')->group(function(){ 
        Route::get('home','HomeController@index')->name('home');
        Route::get('users','HomeController@users')->name('users');
        Route::get('genres','HomeController@genres')->name('genres');
        Route::post('add-genres','HomeController@addGenres')->name('addgenres');
        Route::get('comments/{filmid?}','HomeController@comments')->name('comments');
        Route::post('logout','AdminController@logout')->name('logout');
    });
});