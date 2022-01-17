<?php

namespace App\Repository;

use App\Entity\HorseCoat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorseCoat|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorseCoat|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorseCoat[]    findAll()
 * @method HorseCoat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorseCoatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorseCoat::class);
    }

    // /**
    //  * @return HorseCoat[] Returns an array of HorseCoat objects
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
    public function findOneBySomeField($value): ?HorseCoat
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
