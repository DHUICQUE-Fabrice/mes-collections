<?php

namespace App\Repository;

use App\Entity\HorseSpecies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HorseSpecies|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorseSpecies|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorseSpecies[]    findAll()
 * @method HorseSpecies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorseSpeciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorseSpecies::class);
    }

    // /**
    //  * @return HorseSpecies[] Returns an array of HorseSpecies objects
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
    public function findOneBySomeField($value): ?HorseSpecies
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
