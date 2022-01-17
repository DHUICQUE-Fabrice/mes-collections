<?php

namespace App\Repository;

use App\Entity\HorseSchleich;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorseSchleich|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorseSchleich|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorseSchleich[]    findAll()
 * @method HorseSchleich[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorseSchleichRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorseSchleich::class);
    }

    // /**
    //  * @return HorseSchleich[] Returns an array of HorseSchleich objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HorseSchleich
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
