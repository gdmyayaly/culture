<?php

namespace App\Repository;

use App\Entity\Evalluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evalluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evalluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evalluation[]    findAll()
 * @method Evalluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvalluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evalluation::class);
    }

    // /**
    //  * @return Evalluation[] Returns an array of Evalluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evalluation
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
