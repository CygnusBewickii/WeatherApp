<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function getCoordinates($cityName) {
        return Http::withHeaders(['X-Gismeteo-Token' => '56b30cb255.3443075'])->get('https://api.gismeteo.net/v2/weather/current/4368/?lang=en');
    }
}
