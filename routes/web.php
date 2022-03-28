<?php

use Illuminate\Support\Facades\Route;

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
