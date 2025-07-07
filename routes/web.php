<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherGetController;

Route::get('/', function () {
    return view('selectRegion/japan_map');
});

Route::get("/weather/{location}", [WeatherGetController::class, "showWeatherData"])->name("showWeatherData");

Route::get('/weather/api/{location}', [WeatherGetController::class, 'showWeatherApi']);




