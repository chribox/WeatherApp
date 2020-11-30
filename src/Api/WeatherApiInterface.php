<?php
declare(strict_types=1);

namespace App\Api;

use App\Entity\Location;

/**
 * Interface OpenWeatherApiInterface
 *
 * @author C. Boissieux.
 */
interface WeatherApiInterface
{

    /**
     * @param Location $location
     * @return ApiResponse
     */
    public function getCurrentForGivenCoordinates(Location $location): ApiResponse;
}
