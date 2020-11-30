<?php

namespace App\Tests\Entity;


use App\Entity\Location;
use PHPUnit\Framework\TestCase;

/**
 * Class LocationTest
 *
 * @author C. Boissieux.
 */
class LocationTest extends TestCase
{
    public function testLocation()
    {
        $location = new Location();
        $location->setCity("chicago");
        $location->setLongitude(-87.6297982);
        $location->setLatitude(41.8781136);

        self::assertEquals('chicago', $location->getCity());
        self::assertEquals(-87.6297982, $location->getLongitude());
        self::assertEquals(41.8781136, $location->getLatitude());
    }
}
