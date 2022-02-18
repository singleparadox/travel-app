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


Route::get('places/{city}', 'App\Http\Controllers\PlacesApiController@show');
Route::get('places/reviews/{fsq_id}', 'App\Http\Controllers\PlacesApiController@fetch_place_tips');

Route::get('weather/{city}', 'App\Http\Controllers\WeatherApiController@show');


