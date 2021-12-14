<?php

namespace App\DataFixtures;

use App\Entity\Package;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PackageFixtures extends Fixture
{
    private $sizesData = [
        1,
        2,
        3,
        5,
        10,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->sizesData as $sizeNumber) {
            $package = new Package();
            $package->setSize($sizeNumber);
            $manager->persist($package);
        }

        $manager->flush();
    }
}
