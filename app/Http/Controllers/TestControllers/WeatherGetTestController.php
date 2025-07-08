<?php

namespace App\Http\Controllers\TestControllers;

use App\Services\WeatherInfoService;
use App\Http\Controllers\Controller;

class WeatherGetTestController extends Controller
{
    private WeatherInfoService $weatherInfoService;

    public function __construct(WeatherInfoService $weatherInfoService)
    {
        $this->weatherInfoService = $weatherInfoService;
    }

        //テスト用関数
    public function TestShowWeatherApi($location) {
        try {
            $data = $this->weatherInfoService->getWeatherData($location);

            return response()->json([
                'location' => $location,
                'temp' => $data['temp'],
                'description' => $data['description'],
                'rain' => $data['rain'],
            ]);

        } catch (\Exception $e) {
            \Log::error('天気情報取得エラー: ' . $e->getMessage());

            return response()->json([
                'error' => 'データ取得に失敗しました。'
            ], 400); 
        }
    }
}