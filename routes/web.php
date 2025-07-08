<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherGetController;
use App\Http\Controllers\TestControllers\WeatherGetTestController;


Route::get('/', function () {
    return view('selectRegion/japan_map');
});

Route::get("/weather/{location}", [WeatherGetController::class, "showWeatherData"])->name("showWeatherData");

Route::get('/weather/api/test/{location}', [WeatherGetTestController::class, 'TestShowWeatherApi']);




