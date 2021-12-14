<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\District;
use App\Repository\CityRepository;
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

    private $districtData = [
        'Central',
        'South',
        'West',
        'North',
    ];

    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->cityData as $cityName) {
            $city = new City();
            $city->setName($cityName);
            $manager->persist($city);
        }

        $manager->flush();

        $cityCollection = $this->cityRepository->findAll();

        foreach ($cityCollection as $city) {
            foreach ($this->districtData as $districtName) {
                $district = new District();
                $district = $district->setName($districtName);
                $manager->persist($district);

                $city->addDistrict($district);
                $manager->persist($city);
            }
        }

        $manager->flush();
    }
}
