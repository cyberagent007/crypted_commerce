<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    private $cityData = [
        'Lviv',
        'Lutsk',
        'Kiev',
        'Dnipro'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->cityData as $cityName) {
            $city = new City();
            $city->setName($cityName);
            $manager->persist($city);
        }

        $manager->flush();
    }
}
