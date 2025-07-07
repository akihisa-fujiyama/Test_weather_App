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

        $temp = $data['main']['temp'] ?? 'N/A';
        $description = $data['weather'][0]['description'] ?? '不明';

        if (isset($data['rain']['1h'])) {
            $rain = $data['rain']['1h'] . ' mm (1時間)';
        } elseif (isset($data['rain']['3h'])) {
            $rain = $data['rain']['3h'] . ' mm (3時間)';
        } else {
            $rain = '0 mm';
        }

        return view('showWeatherData/showWeatherData', [
            'location' => $location,
            'temp' => $temp,
            'description' => $description,
            'rain' => $rain,
        ]);
    }
}


