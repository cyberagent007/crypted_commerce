<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findByCity(City $city)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p. = :val')
            ->setParameter('val', $city)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findAllByAvailableSecrets($secrets)
    {
        $productsCollection = [];

        foreach ($secrets as $secret) {
            if (in_array($secret->getProduct(), $productsCollection)) {
                continue;
            }

            $productsCollection[] = $secret->getProduct();
        }

        return $productsCollection;
    }
}
