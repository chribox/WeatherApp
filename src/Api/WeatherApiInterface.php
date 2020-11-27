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
     * @return ApiResponse|null
     */
    public function getWeatherForGivenCity(Location $location): ? ApiResponse;

    /**
     * @param Location $location
     * @return ApiResponse|null
     */
    public function getWeatherForGivenCoordinates(Location $location): ? ApiResponse;
}
