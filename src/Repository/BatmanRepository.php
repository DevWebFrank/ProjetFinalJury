<?php

namespace App\Repository;

use App\Entity\Batman;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Batman|null find($id, $lockMode = null, $lockVersion = null)
 * @method Batman|null findOneBy(array $criteria, array $orderBy = null)
 * @method Batman[]    findAll()
 * @method Batman[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BatmanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Batman::class);
    }

    // /**
    //  * @return Batman[] Returns an array of Batman objects
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
    public function findOneBySomeField($value): ?Batman
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
