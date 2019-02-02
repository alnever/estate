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

Route::group(['prefix' => '{lang?}', 'middleware' => 'lang'], function () {

    Route::get('/','PageController@getIndex')->name('pages.index');
    Route::get('/about','PageController@getAbout')->name('pages.about');
    Route::get('/contact','PageController@getContact')->name('pages.contact');

    Route::get('/estate/{estate}','PageController@getEstate')->name('estates.single');

});

// Secured pages routes

Route::group(['prefix' => '{lang?}', 'middleware' => ['lang','auth']], function() {
    Route::resource('/locations', 'LocationController');
    Route::resource('/estate-types', 'EstateTypeController');
    Route::resource('/estates','EstateController');
    Route::get('/estates/{estate}/restore','EstateController@restore')->name('estates.restore');
});

Route::permanentRedirect('/','/{lang}');



// Authentication routes
Auth::routes(['register' => false]);
