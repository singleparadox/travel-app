<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherApiController extends Controller
{
    private function fetch_weather($city) {
        $params = [
            'appid' => env('OPEN_WEATHER_MAP_API_KEY'),
            'units' => 'metric',
            'exclude' => 'minutely,hourly,daily,alerts'
        ];

        $API_URL = "https://api.openweathermap.org/data/2.5/onecall";

        if ($city === 'tokyo') {
            $coord = explode(',', config('app.places.TOKYO_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $tokyo_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $tokyo_weather;
        }
        if ($city === 'yokohama') {
            $coord = explode(',', config('app.places.YOKOHAMA_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $yokohama_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $yokohama_weather;
        }
        if ($city === 'kyoto') {
            $coord = explode(',', config('app.places.KYOTO_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $kyoto_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $kyoto_weather;
        }
        if ($city === 'osaka') {
            $coord = explode(',', config('app.places.OSAKA_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $osaka_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $osaka_weather;
        }
        if ($city === 'sapporo') {
            $coord = explode(',', config('app.places.SAPPORO_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $sapporo_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $sapporo_weather;
        }
        if ($city === 'nagoya') {
            $coord = explode(',', config('app.places.NAGOYA_GEOCOORDINATE'));
            $params['lat'] = $coord[0];
            $params['lon'] = $coord[1];
            $nagoya_weather = Http::acceptJson()
                ->get($API_URL, $params);
            return $nagoya_weather;
        }
        return [];
    }

    public function show($city) {
        $weather = $this->fetch_weather($city);
        return $weather;
    }
}
