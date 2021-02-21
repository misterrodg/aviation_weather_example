<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//Web
Route::get('/', function () {
  return view('frontend.home');
});

Route::get('/apidocs', 'App\Http\Controllers\Frontend\FrontendController@apidocs');
Route::match(['get','post'],'/weather', 'App\Http\Controllers\Frontend\FrontendController@weather');

//Mockups
Route::get('/edst', 'App\Http\Controllers\Frontend\EDSTController@aircraftListing');
Route::get('/getMessages/{acid}','App\Http\Controllers\Frontend\EDSTController@getMessages');

//CRON
Route::get('/data/{type}', 'App\Http\Controllers\CronController@getDataFile');

//Unused below this line, commented for later use if needed
//Auth::routes();
