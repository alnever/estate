<?php

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


// Front-end pages routes
Route::get('/','PageController@getIndex');
Route::get('/about','PageController@getAbout');
Route::get('/contact','PageController@getContact');
Route::redirect('/home', '/');

// Secured pages routes
Route::group(['middleware' => 'auth'], function() {
    Route::resource('/locations', 'LocationController');
    Route::resource('/estate-types', 'EstateTypeController');
    Route::resource('/estates','EstateController');
});

// Authentication routes
Auth::routes();
