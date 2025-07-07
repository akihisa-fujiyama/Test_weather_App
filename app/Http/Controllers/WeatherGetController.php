<?php

namespace App\Http\Controllers;

use App\Services\WeatherInfoService;

class WeatherGetController extends Controller
{
    private WeatherInfoService $weatherInfoService;

    public function __construct(WeatherInfoService $weatherInfoService)
    {
        $this->weatherInfoService = $weatherInfoService;
    }

    public function showWeatherData($location)
    {
        $data = $this->weatherInfoService->getWeatherData($location);

        if (!$data) {
            return response()->json(['error' => 'データ取得に失敗しました。'], 500);
        }

        $temp = $data['temp'];
        $description = $data['description'];
        $rain = ($data['rain']);

        return view('showWeatherData/showWeatherData', [
            'location' => $location,
            'temp' => $temp,
            'description' => $description,
            'rain' => $rain,
        ]);
    }
}


