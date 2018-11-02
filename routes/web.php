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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin'], function(){
	Route::resource('directions', 'DirectionsController');
	Route::resource('features','FeaturesController');
	Route::resource('amenities','AmenitiesController');
	Route::resource('property-types','PropertyTypesController');
	Route::resource('consultants','ConsultantsController');
	Route::get('/consultants/destroyimage/{id}', 'ConsultantsController@destroyimage');
	Route::resource('managements','ManagementsController');
	Route::resource('users','UsersController');
});

