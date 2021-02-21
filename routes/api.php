<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//All output in JSON format via simple echo, unless specified
//Weather Data
Route::get('/{type}/{icao}', 'App\Http\Controllers\api\apiController@fetchData');
Route::get('/whosonline', 'App\Http\Controllers\api\apiController@whosOnline');
