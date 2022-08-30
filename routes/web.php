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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){

    Route::middleware('guest:admin')->group(function(){    
        Route::get('login','AdminController@index')->name('login');
        Route::post('login','AdminController@login')->name('login');
    });

    Route::middleware('adminauth')->group(function(){ 
        Route::get('home','HomeController@index')->name('home');
        Route::post('logout','AdminController@logout')->name('logout');
    });
});