<?php

namespace App\DataFixtures;

use App\Entity\Secret;
use App\Repository\CityRepository;
use App\Repository\PackageRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SecretFixtures extends Fixture
{
    private CityRepository $cityRepository;
    private PackageRepository $packageRepository;

    public function __construct(CityRepository $cityRepository, PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
        $this->cityRepository = $cityRepository;
    }


    public function load(ObjectManager $manager): void
    {
        $cityCollection = $this->cityRepository->findAll();
        $package = $this->packageRepository->findOneBy(['size', '>', 2]);

        foreach ($cityCollection as $city) {
            $secret = new Secret();
            $secret->setLan(rand(40000, 60000));
            $secret->setLat(rand(40000, 60000));
            $secret->setPhoto('dump1');
            $secret->setDetailedPhoto('dump2');

        }

        $manager->flush();
    }
}
