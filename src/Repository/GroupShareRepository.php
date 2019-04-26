<?php

namespace App\Repository;

use App\Entity\GroupShare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupShare|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupShare|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupShare[]    findAll()
 * @method GroupShare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupShareRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupShare::class);
    }
    
    public function findGroupmember()
    {
        $qb = $this->createQueryBuilder('g');
        
        $qb = $qb->innerJoin('g.user', 'u');
            
        return $qb->getQuery()
            ->getResult();
            
        
    }

    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
