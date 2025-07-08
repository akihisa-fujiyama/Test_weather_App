<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherData;

class WeatherGetControllerTest extends TestCase
{
    use RefreshDatabase; // テストごとにDBをリセット

    /** @test */
    //今日の東京の天気予報データがすでに存在していた場合
    public function it_returns_weather_data_from_cache_if_exists()
    {
        $today = now()->toDateString();

        // キャッシュ用の天気データを作成
        WeatherData::create([
            'location' => '東京',
            'date' => $today,
            'temperature' => 26.7,
            'rain' => 0.3,
            'weather' => '晴れ時々曇り',
        ]);

        // 東京の天気情報を取得するリクエストを送信
        $response = $this->get('/weather/api/test/' . urlencode('東京'));

        $response->assertStatus(200);

        // レスポンスに正しいデータが含まれていることをJSONで検証
        $response->assertJsonFragment([
            'location' => '東京',
            'temp' => 26.7,
            'description' => '晴れ時々曇り',
            'rain' => 0.3,
        ]);
    }

    /** @test */
    //今日の天気予報情報が存在しない場合APIから天気予報情報を取得しDBに保存する場合
    public function it_fetches_weather_from_api_and_stores_to_db_if_no_cache()
    {
        $today = now()->toDateString();

        // キャッシュがないことを確認
        $this->assertDatabaseMissing('weather_data', [
            'location' => '東京',
            'date' => $today,
        ]);

        // モック用のAPIレスポンス
        $fakeApiResponse = [
            'main' => ['temp' => 28.5],
            'weather' => [['description' => '晴れ']],
            'rain' => ['1h' => 0.2],
        ];

        Http::fake([
            'api.openweathermap.org/*' => Http::response($fakeApiResponse, 200),
        ]);

        // 東京の天気情報を取得するリクエストを送信
        $response = $this->get('/weather/api/test/' . urlencode('東京'));

        // DBに新しいデータが保存されたことを確認
        $this->assertDatabaseHas('weather_data', [
            'location' => '東京',
            'date' => $today,
            'temperature' => 28.5,
            'rain' => 0.2,
            'weather' => '晴れ',
        ]);

        // レスポンスが200で、APIレスポンス内容が含まれていることをJSONで確認
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'location' => '東京',
            'temp' => 28.5,
            'description' => '晴れ',
            'rain' => 0.2,
        ]);
    }
}


