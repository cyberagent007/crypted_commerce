<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\CityRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Money\Currency;
use Money\Money;

class ProductFixtures extends Fixture
{
    private $productsData = [
        ['name' => 'G13 VHQ', 'price' => 360.00, 'description' => 'G13, also known as "G-13" and "G Thirteen," is a potent indica marijuana strain and is the subject of many urban legends. According to some accounts, the CIA, FBI, and other agencies gathered the best strains of marijuana from breeders all over the world. '],
        ['name' => 'Tangerine Dream VHQ', 'price' => 240.00, 'description' => 'Tangerine Dream is a sativa-leaning strain with effects that may reduce pain and increase energy.'],
        ['name' => 'MK Ultra VHQ', 'price' => 400.00, 'description' => 'MK Ultra, also known as "MK Ultra OG," is a potent indica marijuana strain made by crossing OG Kush with G13.'],
        ['name' => 'GG4 VHQ', 'price' => 360.00, 'description' => 'Original Glue, also known as "Gorilla Glue," "Original Glue," "GG4," and "Gorilla Glue #4" is a potent hybrid marijuana']
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->productsData as $productDatum) {
            $product = new Product();
            $product->setName($productDatum['name']);
            $product->setDescription($productDatum['description']);
            $product->setPrice((new Money($productDatum['price'], new Currency(Product::CURRENCY_CODE))));
            $product->setPhoto('none');
            $manager->persist($product);
        }


        $manager->flush();
    }
}
