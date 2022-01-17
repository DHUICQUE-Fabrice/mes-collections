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
class SchleichRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorseSchleich::class);
    }

    // /**
    //  * @return Schleich[] Returns an array of Schleich objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Schleich
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
