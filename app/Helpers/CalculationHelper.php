<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class CalculationHelper
{
    public static function calculateRandomCoordinate($ll = '', $miles = 3)
    {
        $ll = explode(',', $ll);

        $MILES_CONSTANT = 1.609344;
        $DECIMAL_PRECISION = 3;

        $longitude = $ll[0] ?? 0;
        $latitude = $ll[1] ?? 0;
        $radius = rand(1, $miles) * $MILES_CONSTANT; // in miles but converted to km

        $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
        $lat_min = $latitude - ($radius / 69);

        $lng_min = number_format($lng_min, $DECIMAL_PRECISION);
        $lat_min = number_format($lat_min, $DECIMAL_PRECISION);

        return "$lng_min,$lat_min";
    }
}
