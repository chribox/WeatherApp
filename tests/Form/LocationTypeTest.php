<?php


namespace App\Tests\Form;

use App\Entity\Location;
use App\Form\LocationType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class LocationTypeTest
 *
 * @author C. Boissieux.
 */
class LocationTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'city' => 'chicago',
            'longitude' => -87.6297982,
            'latitude' => 41.8781136,
        ];

        $location = new Location();
        $form = $this->factory->create(LocationType::class, $location);

        $expected = $this->getBuildLocation();

        $form->submit($formData);

        self::assertTrue($form->isSynchronized());
        self::assertEquals($expected, $location);
    }

    public function testCustomFormView()
    {
        $formData = [
            'city' => 'chicago',
            'longitude' => -87.6297982,
            'latitude' => 41.8781136,
        ];

        $location = $this->getBuildLocation();

        $view = $this->factory->create(LocationType::class, $location)->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            self::assertArrayHasKey($key, $children);
        }
    }

    private function getBuildLocation()
    {
        $location = new Location();
        $location->setCity('chicago');
        $location->setLongitude(-87.6297982);
        $location->setLatitude(41.8781136);

        return $location;
    }

}
