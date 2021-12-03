<?php

namespace App\Repository;

use App\Entity\BienImmobilier;
use App\Entity\BienSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BienImmobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method BienImmobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method BienImmobilier[]    findAll()
 * @method BienImmobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienImmobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BienImmobilier::class);
    }

    public function findBienAvendre()
    {
        return $this->createQueryBuilder('b')
            ->where('b.status=0')
            ->getQuery();
    }

    public function findBienAlouer()
    {
        return $this->createQueryBuilder('b')
            ->where('b.status=1')
            ->getQuery();
    }

    public function findBienById($id)
    {
        return $this->createQueryBuilder('b')
            ->where('b.user='.$id)
            ->getQuery()
            ->getResult();
    }



    public function findAllVisibleQuery(BienSearch $search)
    {
        $query= $this->findQuery();
            if($search->getMaxPrice())
            {
                $query = $query
                    ->andWhere('b.prix <= :maxPrice')
                    ->setParameter('maxPrice', $search->getMaxPrice());
            }
        if($search->getMinSurface())
        {
            $query = $query
                ->andWhere('b.surface >= :minSurface')
                ->setParameter('minSurface', $search->getMinSurface());
        }
           return $query->getQuery();

    }

    public function findQuery()
    {
        return $this->createQueryBuilder('b')
            ->where('b.sold = false');

    }

    // /**
    //  * @return BienImmobilier[] Returns an array of BienImmobilier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BienImmobilier
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
