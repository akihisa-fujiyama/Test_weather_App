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
        try{
            $data = $this->weatherInfoService->getWeatherData($location);

            if (!$data) {
                return response()->json(['error' => 'データ取得に失敗しました。'], 400);
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
        }catch (\Exception $e) {
            \Log::error('天気情報取得エラー: '.$e->getMessage());

            return view('errorView/errorGetApi', [
                'error' => 'データ取得中にエラーが発生しました。'
            ]);
        }
    }
}