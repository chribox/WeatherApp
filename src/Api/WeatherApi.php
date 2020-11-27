<?php
declare(strict_types=1);

namespace App\Api;

use App\Entity\Location;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Serializer\Serializer;

/**
 * Class OpenWeatherApi
 *
 * @author C. Boissieux.
 */
class WeatherApi implements WeatherApiInterface
{
    /**
     * @var Client
     */
    private $weatherClient;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * OpenWeatherApi constructor.
     * @param Client $weatherClient
     * @param Serializer $serializer
     * @param $apiKey
     */
    public function __construct(Client $weatherClient, Serializer $serializer, $apiKey)
    {
        $this->weatherClient = $weatherClient;
        $this->serializer = $serializer;
        $this->apiKey = $apiKey;
    }

    /**
     * @param Location $location
     * @return ApiResponse
     * @throws ClientException
     */
    public function getWeatherForGivenCity(Location $location): ? ApiResponse
    {
        $baseUri = '/data/2.5/weather?lang=fr&units=metric&APPID=' . $this->apiKey;
        $params = sprintf('&q=%s', $location->getCity());
        try {
            $response = $this->weatherClient->get($baseUri . $params);
            $apiResponse = $this->serializer->deserialize($response->getBody()->getContents(), ApiResponse::class, 'json');
        } catch (ClientException $e) {
            $apiResponse = null;
        }

        return $apiResponse;
    }

    /**
     * @param Location $location
     * @return ApiResponse
     * @throws ClientException
     */
    public function getWeatherForGivenCoordinates(Location $location): ? ApiResponse
    {
        $baseUri = '/data/2.5/weather?lang=fr&units=metric&APPID=' . $this->apiKey;
        $params = sprintf('&lat=%s&lon=%s', $location->getLatitude(), $location->getLongitude());
        try {
            $response = $this->weatherClient->get($baseUri . $params);
            $apiResponse = $this->serializer->deserialize($response->getBody()->getContents(), ApiResponse::class, 'json');
        } catch (ClientException $e) {
            $apiResponse = null;
        }

        return $apiResponse;
    }
}
