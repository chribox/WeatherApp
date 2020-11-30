<?php
declare(strict_types=1);


namespace App\Tests\Api;

use App\Api\ApiResponse;
use App\Api\WeatherApi;
use App\Api\WeatherApiInterface;
use App\Entity\Location;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Serializer\SerializerInterface;
use Prophecy\PhpUnit\ProphecyTrait;


/**
 * Class WeatherApiTest
 *
 * @author C. Boissieux.
 */
class WeatherApiTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var Client|ObjectProphecy
     */
    private $weatherClient;

    /**
     * @var SerializerInterface|ObjectProphecy
     */
    private $serializer;

    /**
     * @var WeatherApiInterface
     */
    private $weatherApi;


    public function setUp():void
    {
        $this->weatherClient = $this->prophesize(Client::class);
        $this->serializer = $this->prophesize(SerializerInterface::class);
        $apiKey = '123456';
        $this->weatherApi = new WeatherApi(
            $this->weatherClient->reveal(),
            $this->serializer->reveal(),
            $apiKey
        );
    }

    public function testGetCurrentForGivenCoordinates()
    {
        $location = New Location();
        $location->setCity("chicago");
        $location->setLongitude(-87.6297982);
        $location->setLatitude(41.8781136);

        $guzzleResponse = new Response();
        $apiResponse = new ApiResponse();

        $this
            ->weatherClient
            ->get(Argument::any())
            ->shouldBeCalled()
            ->willReturn($guzzleResponse);

        $this
            ->serializer
            ->deserialize(Argument::any(), Argument::any(), Argument::any())
            ->willReturn($apiResponse);


        $result = $this->weatherApi->getCurrentForGivenCoordinates($location);

        self::assertInstanceOf(ApiResponse::class, $result);
    }
}
