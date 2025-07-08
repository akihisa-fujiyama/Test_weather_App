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

        // 既存の天気情報がないか確認　$cacheから変更
        $weatherRecord = WeatherData::where('location', $location)
            ->where('date', $today)
            ->first();

        if ($weatherRecord) {
            return [
                'temp' => $weatherRecord->temperature,
                'description' => $weatherRecord->weather,
                'rain' => $weatherRecord->rain,
            ];
        }


            // 都道府県名チェック
        if (!isset($this->prefectureKanjiToCity[$location])) {
            $message = "不正な都道府県名が指定されました: {$location}";
            \Log::error('都道府県名エラー', ['message' => $message]);
            throw new \InvalidArgumentException($message);
        }

        $city = $this->prefectureKanjiToCity[$location];


        //APIから情報取得
        $city = $this->prefectureKanjiToCity[$location];
        $apiKey = config('services.openweather.key');

        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city . ',jp',
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'ja',
            ]);
        } catch (\Exception $e) {
            \Log::error('API呼び出し中にエラーが発生: ' . $e->getMessage());
            throw new \RuntimeException('天気APIの取得に失敗しました。', 0, $e);
        }

                //api通信の返答が失敗した時。
        if (!$response->ok()) {
            // エラーログを残す
            \Log::error('OpenWeather APIエラー', [
                'status' => $response->status(),
                'body' => $response->body(),
        ]);

            // エラーステータスに応じて例外をスロー
            throw new \RuntimeException('OpenWeather APIからエラー応答が返されました。ステータスコード: ' . $response->status());
        }


        $data = $response->json();

        $weatherInfo = $this->extractWeatherInfo($data);

        //DBに天気情報保存
        WeatherData::create([
            'location' => $location,
            'date' => $today,
            'temperature' => $weatherInfo['temp'],
            'rain' => $weatherInfo['rain'],
            'weather' => $weatherInfo['description'],
        ]);

        return $weatherInfo;
    }

    //getWeatherDataから分離
    private function extractWeatherInfo(array $data): array
    {
        $temp = $data['main']['temp'] ?? null;
        $description = $data['weather'][0]['description'] ?? null;
        $rain = $data['rain']['1h'] ?? ($data['rain']['3h'] ?? 0);

        return [
            'temp' => $temp,
            'description' => $description,
            'rain' => $rain,
        ];
    }
}
