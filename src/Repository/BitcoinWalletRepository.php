<?php

namespace App\Repository;

use App\Entity\BitcoinWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BitcoinWallet|null find($id, $lockMode = null, $lockVersion = null)
 * @method BitcoinWallet|null findOneBy(array $criteria, array $orderBy = null)
 * @method BitcoinWallet[]    findAll()
 * @method BitcoinWallet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BitcoinWalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BitcoinWallet::class);
    }

    // /**
    //  * @return BitcoinWallet[] Returns an array of BitcoinWallet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BitcoinWallet
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
