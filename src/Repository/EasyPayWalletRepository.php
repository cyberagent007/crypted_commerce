<?php

namespace App\Repository;

use App\Entity\EasyPayWallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EasyPayWallet|null find($id, $lockMode = null, $lockVersion = null)
 * @method EasyPayWallet|null findOneBy(array $criteria, array $orderBy = null)
 * @method EasyPayWallet[]    findAll()
 * @method EasyPayWallet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EasyPayWalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EasyPayWallet::class);
    }

    // /**
    //  * @return EasyPayWallet[] Returns an array of EasyPayWallet objects
    //  */

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findAvailableWallet()
    {
        return $this->createQueryBuilder('epw')
            ->andWhere('epw.blockedUntil IS NULL')
            ->andWhere('epw.customerOrder IS NULL')
            ->orderBy('epw.id', 'ASC')
            ->getQuery()
            ->getSingleResult();
        ;
    }


    /*
    public function findOneBySomeField($value): ?EasyPayWallet
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
