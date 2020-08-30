<?php

use Illuminate\Support\Facades\Route;

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
// Address and Zipcode Search Routes
Route::get('search', 'SearchApiController@searchAddress');
Route::get('search-zip', 'SearchApiController@searchZipCode');

// Address Routes
Route::post('address', 'AddressController@store');
Route::get('address', 'AddressController@index');
