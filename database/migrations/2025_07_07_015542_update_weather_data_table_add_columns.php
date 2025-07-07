<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('weather_data', function (Blueprint $table) {
            $table->dropColumn('forecast_json'); // forecast_jsonカラム削除
            $table->float('temperature')->nullable(); // 気温
            $table->float('rain')->nullable();        // 降水量
            $table->string('weather')->nullable();    // 天気の説明
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weather_data', function (Blueprint $table) {
            $table->json('forecast_json')->nullable(); // 戻す用
            $table->dropColumn(['temperature', 'rain', 'weather']);
        });
    }
};
