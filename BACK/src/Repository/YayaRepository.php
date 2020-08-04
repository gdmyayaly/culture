<?php

namespace App\Repository;

use App\Entity\Yaya;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Yaya|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yaya|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yaya[]    findAll()
 * @method Yaya[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YayaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yaya::class);
    }

    // /**
    //  * @return Yaya[] Returns an array of Yaya objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yaya
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
