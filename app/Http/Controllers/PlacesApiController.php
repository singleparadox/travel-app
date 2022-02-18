<?php

namespace App\Http\Controllers;

use App\Helpers\CalculationHelper;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlacesApiController extends Controller
{
    private function fetch_city($city)
    {
        $params = [
            'limit' => config('app.PLACES_FETCH_LIMIT'),
            'query' => ''
        ];

        $API_URL = "https://api.foursquare.com/v3/places/nearby";

        $headers =  [
            'Authorization' => env('FOURSQUARE_API_KEY')
        ];

        if ($city === 'tokyo') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.TOKYO_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            
            return $response;
        }
        if ($city === 'yokohama') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.YOKOHAMA_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            return $response;
        }

        if ($city === 'kyoto') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.KYOTO_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            return $response;
        }
        if ($city === 'osaka') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.OSAKA_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            return $response;
        }
        if ($city === 'sapporo') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.SAPPORO_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            return $response;
        }
        if ($city === 'nagoya') {
            $params['ll'] = CalculationHelper::calculate_random_coordinate(config('app.places.NAGOYA_GEOCOORDINATE'));
            $response = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params);
            return $response;
        }

        return [];
    }

    public function fetch_place_tips($fsq_id)
    {
        $params = [
            'sort' => 'popular'
        ];
        $API_URL = "https://api.foursquare.com/v3/places/$fsq_id/tips";
        $headers = [
            'Authorization' => env('FOURSQUARE_API_KEY')
        ];

        $tips = Http::acceptJson()
            ->withHeaders($headers)
            ->get($API_URL, $params)
            ->json();

        $formatted_tips = [];
        foreach ($tips as $key => $value) {
            $date = new \DateTime($value['created_at']);

            $formatted_tips[$key] = $value;
            $formatted_tips[$key]['f_created_at'] = $date->format('F j, Y');
        }

        return $formatted_tips;
    }
    
    private function add_image_to_attractions($attractions) {
        $decoded_attractions = json_decode($attractions, true)['results'] ?? [];
        $params = [
            'sort' => 'popular',
            'limit' => 1
        ];
        $headers = [
            'Authorization' => env('FOURSQUARE_API_KEY')
        ];
        
        foreach ($decoded_attractions as $key => $value) {
            $fsq_id = $value['fsq_id'];
            $API_URL = "https://api.foursquare.com/v3/places/$fsq_id/photos";

            $image = Http::acceptJson()
                ->withHeaders($headers)
                ->get($API_URL, $params)
                ->json();

            if (count($image) > 0) {
                $decoded_attractions[$key]['image'] = $image[0]['prefix'] . '800x800' . $image[0]['suffix'];
            } else {
                $decoded_attractions[$key]['image'] = null;
            }

        }

        return json_encode($decoded_attractions);
    }

    public function show($city)
    {
        $attractions = $this->fetch_city($city);

        return $this->add_image_to_attractions($attractions);
    }
}
