<?php

namespace App\Repository;

use App\Entity\Allsession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Allsession|null find($id, $lockMode = null, $lockVersion = null)
 * @method Allsession|null findOneBy(array $criteria, array $orderBy = null)
 * @method Allsession[]    findAll()
 * @method Allsession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllsessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Allsession::class);
    }

    // /**
    //  * @return Allsession[] Returns an array of Allsession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Allsession
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //  /**
    //   * @return Allsession[] Returns an array of Allsession objects
    //   */
    
    // public function findByExampleField($date1)
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.date >= :val')
    //         ->setParameter('val', $date1)
    //         ->orderBy('a.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    
    // public function samadate($value): ?Allsession
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.date = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }

    /**
     * @return Allsession[] Returns an array of Allsession objects
     */
    
    public function sevenlastevaluation()
    {
        return $this->createQueryBuilder('a')
            // ->andWhere('a.exampleField = :val')
            // ->setParameter('val', $value)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(7)
            ->getQuery()
            ->getResult()
        ;
    }
    
    
}
