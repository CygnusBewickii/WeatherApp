<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    /**
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse|mixed|string
     */

    public function getWeather(Request $request) {

        /*
         * Returns weather JSON with current weather and forecast for 5 days every 3 hours
         * If city doesn't exist returns json with error and code, also set response status to 404
         * */

        $cityName = $request->cityName;
        $coordinates = $this->getCityCoordinates($cityName);

        if ($coordinates == 'error') {
            return response()->json(['error' => 'City doesn\'t exist', 'code' => '404'], 404);
        }
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


    /**
     * @param $name
     * @return array|string
     */

    private function getCityCoordinates($name) {
        /*
         * Returns city's coordinates by it's name
         * If city has already been requested it will be read from redis
         * If it hasn't function will get it with API and set coordinates in redis
         * */


        $coordinates = \Redis::LRange("{$name}_coordinates", 0, 1);

        if ($coordinates != null) {
            return $coordinates;
        }
        else {
            $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
                'q' => $name,
                'appid' => env('WEATHER_API_KEY'),
            ]);

            if (empty(json_decode($response))) {
                return 'error';
            }

            $lat = $response[0]["lat"];
            $lon = $response[0]["lon"];
            $coordinates = [$lat, $lon];
            \Redis::Rpush("{$name}_coordinates", $lat, $lon);
            return $coordinates;
        }
    }

    /**
     * @param $coordinates
     * @return \Illuminate\Http\Client\Response
     */

    private function getCurrentWeather($coordinates) {
        /*
         * Returns current weather JSON with API
         * */

        $weather = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => $coordinates[0],
            'lon' => $coordinates[1],
            'units' => 'metric',
            'appid' => env('WEATHER_API_KEY'),
            'lang' => 'ru',
        ]);
        return $weather;
    }

    /**
     * @param $coordinates
     * @return \Illuminate\Http\Client\Response
     */

    private function getForecast($coordinates) {
        /*
         * Returns forecast JSON with API
         * */

        $forecast = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'lat' => $coordinates[0],
            'lon' => $coordinates[1],
            'units' => 'metric',
            'appid' => env('WEATHER_API_KEY'),
            'lang' => 'ru',
        ]);
        return $forecast;
    }
}
