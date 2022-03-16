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
    return view('bookCar');
});

// bookCar
Route::get('bookCar', 'App\Http\Controllers\CarOnRentController@create');

// viewBooking
Route::get('viewBooking', 'App\Http\Controllers\CarOnRentController@show');

// deleteBooking
Route::get('deleteBooking/{id}', 'App\Http\Controllers\CarOnRentController@destroy');

// submitBooking
Route::post('submitBooking', 'App\Http\Controllers\CarOnRentController@store');
