<?php

namespace App\Repository;

use App\Entity\AgentImmo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgentImmo|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentImmo|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentImmo[]    findAll()
 * @method AgentImmo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentImmoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentImmo::class);
    }

    // /**
    //  * @return AgentImmo[] Returns an array of AgentImmo objects
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
    public function findOneBySomeField($value): ?AgentImmo
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
