<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/validity', 'App\Http\Controllers\validity@routecheck');
Route::get('/traveller/{seat_check_id}/{pax_count}/{city1}/{city2}/{total_price}' ,'App\Http\Controllers\bookingController@bookingIndex');
Route::get('/traveller/ticket' ,'App\Http\Controllers\bookingController@bookingCheck');
