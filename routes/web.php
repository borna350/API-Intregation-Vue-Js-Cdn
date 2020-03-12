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
Route::get('/show/location', 'CountryController@getLocation');
Route::get('/convert/zone', 'CountryController@convertZone');
Route::get('/country/list', 'CountryController@countryList')->name('country.list');
Route::get('/update/country/{country}', 'CountryController@updateCountry')->name('update.country');
