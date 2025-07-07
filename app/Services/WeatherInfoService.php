<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\WeatherData;
use Carbon\Carbon;

class WeatherInfoService
{
    private array $prefectureKanjiToCity = [
        '北海道' => 'Sapporo',
        '青森' => 'Aomori',
        '岩手' => 'Morioka',
        '宮城' => 'Sendai',
        '秋田' => 'Akita',
        '山形' => 'Yamagata',
        '福島' => 'Fukushima',
        '茨城' => 'Mito',
        '栃木' => 'Utsunomiya',
        '群馬' => 'Maebashi',
        '埼玉' => 'Saitama',
        '千葉' => 'Chiba',
        '東京' => 'Tokyo',
        '神奈川' => 'Yokohama',
        '新潟' => 'Niigata',
        '富山' => 'Toyama',
        '石川' => 'Kanazawa',
        '福井' => 'Fukui',
        '山梨' => 'Kofu',
        '長野' => 'Nagano',
        '岐阜' => 'Gifu',
        '静岡' => 'Shizuoka',
        '愛知' => 'Nagoya',
        '三重' => 'Tsu',
        '滋賀' => 'Otsu',
        '京都' => 'Kyoto',
        '大阪' => 'Osaka',
        '兵庫' => 'Kobe',
        '奈良' => 'Nara',
        '和歌山' => 'Wakayama',
        '鳥取' => 'Tottori',
        '島根' => 'Matsue',
        '岡山' => 'Okayama',
        '広島' => 'Hiroshima',
        '山口' => 'Yamaguchi',
        '徳島' => 'Tokushima',
        '香川' => 'Takamatsu',
        '愛媛' => 'Matsuyama',
        '高知' => 'Kochi',
        '福岡' => 'Fukuoka',
        '佐賀' => 'Saga',
        '長崎' => 'Nagasaki',
        '熊本' => 'Kumamoto',
        '大分' => 'Oita',
        '宮崎' => 'Miyazaki',
        '鹿児島' => 'Kagoshima',
        '沖縄' => 'Naha',
    ];

    public function getWeatherData(string $location): ?array
    {
        $today = Carbon::now('Asia/Tokyo')->toDateString();

        // キャッシュ確認
        $cache = WeatherData::where('location', $location)
            ->where('date', $today)
            ->first();

        if ($cache) {
            return json_decode($cache->forecast_json, true);
        }

        // キャッシュなし→API取得
        if (!isset($this->prefectureKanjiToCity[$location])) {
            return null;
        }

        $city = $this->prefectureKanjiToCity[$location];
        $apiKey = config('services.openweather.key');

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city . ',jp',
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'ja',
        ]);

        if (!$response->ok()) {
            return null;
        }

        $data = $response->json();

        WeatherData::create([
            'location' => $location,
            'date' => $today,
            'forecast_json' => json_encode($data),
        ]);

        return $data;
    }
}
