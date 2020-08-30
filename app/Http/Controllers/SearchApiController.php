<?php

namespace App\Http\Controllers;

class SearchApiController extends Controller
{
    public function searchAddress()
    {
        $query = request()->get('q');
        if (env('APP_ENV') === 'local') {
            $response = json_decode('{"suggestions": [{"text": "3301 E South 13th St, York NE","city": "York","state": "NE"},{"text": "3301 W South 1st St, Findlay IL","city": "Findlay","state": "IL"},{"text": "3301 E South 1st St, Findlay IL","city": "Findlay","state": "IL"},{"text": "3301 E South 1st St, Herrick IL","city": "Herrick","state": "IL"},{"text": "3301 SE South 1st St, Creston WA","city": "Creston","state": "WA"},{"text": "3301 SW South 1st St, Creston WA","city": "Creston","state": "WA"},{"text": "3301 E South 11th St, Abilene TX","city": "Abilene","state": "TX"},{"text": "3301 W South 10th St, Shelbyville IL","city": "Shelbyville","state": "IL"},{"text": "3301 W South 11th St, Shelbyville IL","city": "Shelbyville","state": "IL"},{"text": "3301 W South 12th St, Shelbyville IL","city": "Shelbyville","state": "IL"}]}');
            return response()->json($response);
        }
        $apiInstance = new \App\Utils\SmartyStreets();
        $apiResult   = $apiInstance->lookupAddress($query);
        return $apiResult;
    }

    public function searchZipCode()
    {
        $city  = request()->get('city');
        $state = request()->get('state');
        if (env('APP_ENV') === 'local') {
            $response = json_decode('{"zipCodes": [{"zipcode": "62534","latitude": 39.52077,"longitude": -88.75366}]}');
            return response()->json($response);
        }
        $apiInstance = new \App\Utils\SmartyStreets();
        $apiResult   = $apiInstance->getZipCode($city, $state);
        return $apiResult;
    }
}
