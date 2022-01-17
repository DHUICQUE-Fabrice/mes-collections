<?php

namespace App\Repository;

use App\Entity\PetshopSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PetshopSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetshopSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetshopSize[]    findAll()
 * @method PetshopSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetshopSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetshopSize::class);
    }

    // /**
    //  * @return PetshopSize[] Returns an array of PetshopSize objects
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
    public function findOneBySomeField($value): ?PetshopSize
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
