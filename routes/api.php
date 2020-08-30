<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * API Used for AutoComplete Field
 */
Route::get('search', function () {
    $query = request()->get('q');
    if (env('APP_ENV') === 'local') {
        $response = json_decode('{"suggestions": [{"text": "3301 E South 13th St, York NE","city": "York","state": "NE"},{"text": "3301 W South 1st St, Findlay IL","city": "Findlay","state": "IL"},{"text": "3301 E South 1st St, Findlay IL","city": "Findlay","state": "IL"},{"text": "3301 E South 1st St, Herrick IL","city": "Herrick","state": "IL"},{"text": "3301 SE South 1st St, Creston WA","city": "Creston","state": "WA"},{"text": "3301 SW South 1st St, Creston WA","city": "Creston","state": "WA"},{"text": "3301 E South 11th St, Abilene TX","city": "Abilene","state": "TX"},{"text": "3301 W South 10th St, Shelbyville IL","city": "Shelbyville","state": "IL"},{"text": "3301 W South 11th St, Shelbyville IL","city": "Shelbyville","state": "IL"},{"text": "3301 W South 12th St, Shelbyville IL","city": "Shelbyville","state": "IL"}]}');
        return response()->json($response);
    }
    $apiInstance = new \App\Utils\SmartyStreets();
    $apiResult   = $apiInstance->lookupAddress($query);
    return $apiResult;
});

/**
 * API Used for Zipcode
 */
Route::get('search-zip', function () {
    $city  = request()->get('city');
    $state = request()->get('state');
    if (env('APP_ENV') === 'local') {
        $response = json_decode('{"zipCodes": [{"zipcode": "62534","latitude": 39.52077,"longitude": -88.75366}]}');
        return response()->json($response);
    }
    $apiInstance = new \App\Utils\SmartyStreets();
    $apiResult   = $apiInstance->getZipCode($city, $state);
    return $apiResult;
});

Route::post('address', function () {
    \App\Address::create(request()->all());
});

Route::get('address', function () {
    return \App\Address::orderBy('id', 'DESC')->paginate(2);
});
