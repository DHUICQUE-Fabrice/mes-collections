<?php

namespace App\Repository;

use App\Entity\ObjectFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ObjectFamily|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectFamily|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectFamily[]    findAll()
 * @method ObjectFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectFamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjectFamily::class);
    }

    // /**
    //  * @return ObjectFamily[] Returns an array of ObjectFamily objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ObjectFamily
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
