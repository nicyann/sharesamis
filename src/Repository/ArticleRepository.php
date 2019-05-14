<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Borrow;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
      
    }
    
    
    
    /**
     * @param int $id Id du groupe
     * @return mixed
     */
    public function findByGroupShare(int $id)
    {
        $qb = $this->createQueryBuilder('a');
        
        $qb = $qb->select('a')
            ->innerJoin('a.user', 'u')
            ->leftJoin('u.groupShares', 'g')
            ->leftJoin('u.members', 'm')
            ->leftJoin('m.groupShare', 'gm')
            ->where($qb->expr()->orX(
                $qb->expr()->andX(
                    $qb->expr()->eq('m.isValid', true),
                    $qb->expr()->eq('gm.id', ':id')
                ),
                $qb->expr()->eq('g.id', ':id')
            ))
            ->setParameter(':id', $id)
        ;
        
        return $qb->getQuery()->getResult();
    }
    
    
    public function findArticleBorrowOut (Status $status, User $user)
    {
        
        $qb= $this->createQueryBuilder('a');
        $qb = $qb->select('a')
            ->innerJoin('a.user', 'u')
            ->innerJoin('a.status', 's')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('a.user' , ':currentuser'),
                $qb->expr()->eq('a.status', ':status')
                )

            )
//            ->where( 'user = :currentuser')
//            ->andWhere('a.status = :status' )
            ->setParameter(':currentuser', $user)
            ->setParameter(':status', $status)
            
            

             ;
        return $qb->getQuery()->getResult();

      
    }
    
    /**
     * @param string $sq
     * @return Query
     */
    
    public function searchBy(string $sq):Query
    {
        $sq ="%$sq%";
        
        $qb = $this->createQueryBuilder('a');
        $qb = $qb
            ->innerJoin('a.category','c')
            ->where($qb->expr()->orX(
                $qb->expr()->like('a.name',':sq'),
                $qb->expr()->like('a.description',':sq'))
//            ->where($qb->expr()->orX(
//                $qb->expr()->eq('a.name.',':sq'),
//                $qb->expr()->eq('a.description',':sq'),
//                $qb->expr()->eq('c.name', ':sq'))
            );
        return $qb->setParameter(':sq',$sq)->getQuery();
    }
    
    
     /**
      * @return Article[] Returns an array of Article objects
      */

    

    /*
    public function findOneBySomeField($value): ?Article
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
