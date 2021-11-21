<?php

namespace App\Repository;

use App\Entity\AgenceImmobilier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgenceImmobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgenceImmobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgenceImmobilier[]    findAll()
 * @method AgenceImmobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgenceImmobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgenceImmobilier::class);
    }

    // /**
    //  * @return AgenceImmobilier[] Returns an array of AgenceImmobilier objects
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
    public function findOneBySomeField($value): ?AgenceImmobilier
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
