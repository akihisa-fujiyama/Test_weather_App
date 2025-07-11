<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    protected $table = 'weather_data';  // テーブル名を明示

    protected $fillable = [
        'location',
        'date',
        'temperature',
        'rain',
        'weather',
    ];

}

