<?php

namespace App\Entity;

use App\Entity\PetshopSpecies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PetshopSpecies|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetshopSpecies|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetshopSpecies[]    findAll()
 * @method PetshopSpecies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetshopSpeciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetshopSpecies::class);
    }

    // /**
    //  * @return PetshopSpecies[] Returns an array of PetshopSpecies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PetshopSpecies
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
