<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/create/country', 'CountryController@create');
Route::get('/country', 'CountryController@index');

Route::get('/getLocation', 'CountryController@getLocationInfo');

Route::post('/convert', 'CountryController@convertTime');
Route::get('/show/{country}', 'CountryController@show');
Route::post('/store', 'CountryController@store');
Route::put('/country/update/{country}', 'CountryController@update');
Route::get('/country/edit/{country}', 'CountryController@edit');

Route::get('/vue/table', 'CountryController@vueTable');
Route::delete('/country/delete/{country}', 'CountryController@destroy');


