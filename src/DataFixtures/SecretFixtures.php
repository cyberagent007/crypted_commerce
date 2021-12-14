<?php

namespace App\DataFixtures;

use App\Entity\Secret;
use App\Repository\CityRepository;
use App\Repository\PackageRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SecretFixtures extends Fixture implements DependentFixtureInterface
{
    private CityRepository $cityRepository;
    private PackageRepository $packageRepository;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(
        CityRepository $cityRepository,
        PackageRepository $packageRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository
    ) {
        $this->packageRepository = $packageRepository;
        $this->cityRepository = $cityRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }


    public function load(ObjectManager $manager): void
    {
        $cityCollection = $this->cityRepository->findAll();
        $package = $this->packageRepository->findOneBy([]);
        $user = $this->userRepository->findOneBy([]);
        $products = $this->productRepository->findAll();

        foreach ($cityCollection as $city) {
            foreach ($products as $product) {
                $secret = new Secret();
                $secret->setLan(rand(40000, 60000));
                $secret->setLat(rand(40000, 60000));
                $secret->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
                $secret->setPhoto('dump1');
                $secret->setDetailedPhoto('dump2');
                $package->addSecret($secret);
                $district = $city->getDistricts()->first();
                $district->addSecret($secret);
                $user->addSecret($secret);
                $city->addSecret($secret);
                $product->addSecret($secret);

                $manager->persist($secret);
            }

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PackageFixtures::class,
            CityFixtures::class,
            UserFixtures::class,
            ProductFixtures::class,
        ];
    }
}
