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
Route::get('/','PageController@getIndex')->name('pages.index');
Route::get('/about','PageController@getAbout');
Route::get('/contact','PageController@getContact');
Route::redirect('/home', '/');

Route::get('/estate/{estate}','PageController@getEstate')->name('estates.single');

// Secured pages routes
Route::group(['middleware' => 'auth'], function() {
    Route::resource('/locations', 'LocationController');
    Route::resource('/estate-types', 'EstateTypeController');
    Route::resource('/estates','EstateController');
    Route::get('/estates/{estate}/restore','EstateController@restore')->name('estates.restore');
});

// Authentication routes
Auth::routes(['register' => false]);
