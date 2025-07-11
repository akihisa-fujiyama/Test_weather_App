<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Models\WeatherData;
use Carbon\Carbon;

class ErrorHandlingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    //架空の件が呼ばれた場合
    public function it_returns_error_when_invalid_location_is_given()
    {
        Http::fake([
            'api.openweathermap.org/*' => Http::response([
                'main' => ['temp' => 28.0],
                'weather' => [['description' => '晴れ']],
                'rain' => ['1h' => 0.0],
            ], 200),
        ]);
        $response = $this->get('/weather/api/test/' . urlencode('架空県'));

        $response->assertStatus(400);
        $response->assertJson(['error' => 'データ取得に失敗しました。']);
    }

    /** @test */
    //API取得に失敗した場合
    public function it_returns_error_when_api_fails()
    {
        Http::fake([
            'api.openweathermap.org/*' => Http::response([], 500),
        ]);

        $response = $this->get('/weather/api/test/' . urlencode('富山'));

        $response->assertStatus(400);
        $response->assertJson(['error' => 'データ取得に失敗しました。']);
    }

    /** @test */
    //同じ日付・同じ場所で天気データ取得を複数回リクエストしても、DBに重複レコードが作成されない
    public function it_does_not_create_duplicate_records_for_same_date_and_location()
    {
        Http::fake([
            'api.openweathermap.org/*' => Http::response([
                'main' => ['temp' => 28.0],
                'weather' => [['description' => '晴れ']],
                'rain' => ['1h' => 0.0],
            ], 200),
        ]);
        $today = now()->toDateString();

        $this->get('/weather/api/test/' . urlencode('東京'));
        $this->get('/weather/api/test/' . urlencode('東京'));

        //東京のレコードが１件しかないことを確かめる
        $this->assertDatabaseCount('weather_data', 1);
        $this->assertDatabaseHas('weather_data', [
            'location' => '東京',
            'date' => $today,
            'temperature' => 28,
            'rain' => 0.0,
            'weather' => '晴れ',
        ]);
    }
}


