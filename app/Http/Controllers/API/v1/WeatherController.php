<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($cityName) {
        $coordinates = $this->getCityCoordinates($cityName);
        $data = Cache::get("{$coordinates[0]}.{$coordinates[1]}_weather");
        if ($data != null) {
            return $data;
        }
        else {
            $currentWeather = $this->getCurrentWeather($coordinates);
            $forecast = $this->getForecast($coordinates);
            $data = json_encode([
                'currentWeather' => json_decode($currentWeather),
                "forecast" => json_decode($forecast)],
                JSON_UNESCAPED_UNICODE);
            Cache::add("{$coordinates[0]}.{$coordinates[1]}_weather", $data, 15 * 60);
            return $data;
        }
    }


    private function getCityCoordinates($name) {
        $coordinates = \Redis::LRange("{$name}_coordinates", 0, 1);
        if ($coordinates != null) {
            return $coordinates;
        }
        else {
            $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
                'q' => $name,
                'appid' => env('WEATHER_API_KEY'),
            ]);
            $lat = $response[0]["lat"];
            $lon = $response[0]["lon"];
            $coordinates = [$lat, $lon];
            \Redis::Rpush("{$name}_coordinates", $lat, $lon);
            return $coordinates;
        }
    }

    private function getCurrentWeather($coordinates) {
        $weather = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $coordinates[0],
            'lon' => $coordinates[1],
            'units' => 'metric',
            'appid' => env('WEATHER_API_KEY'),
            'lang' => 'ru',
        ]);
        return $weather;
    }

    private function getForecast($coordinates) {
        $forecast = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'lat' => $coordinates[0],
            'lon' => $coordinates[1],
            'units' => 'metric',
            'appid' => env('WEATHER_API_KEY'),
            'lang' => 'ru',
            'cnt' => '16',
        ]);
        return $forecast;
    }
}
