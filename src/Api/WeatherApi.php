<?php
declare(strict_types=1);

namespace App\Api;

use App\Entity\Location;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\SerializerInterface;

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
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * OpenWeatherApi constructor.
     * @param Client $weatherClient
     * @param SerializerInterface $serializer
     * @param $apiKey
     */
    public function __construct(Client $weatherClient, SerializerInterface $serializer, $apiKey)
    {
        $this->weatherClient = $weatherClient;
        $this->serializer = $serializer;
        $this->apiKey = $apiKey;
    }

    /**
     * @param Location $location
     * @return ApiResponse
     */
    public function getCurrentForGivenCoordinates(Location $location): ApiResponse
    {
        $baseUri = '/data/2.5/weather?lang=fr&units=metric&APPID=' . $this->apiKey;
        $params = sprintf('&lat=%s&lon=%s', $location->getLatitude(), $location->getLongitude());
        $response = $this->weatherClient->get($baseUri . $params);

        return $this->serializer->deserialize($response->getBody()->getContents(), ApiResponse::class, 'json');
    }
}
