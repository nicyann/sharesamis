<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Borrow;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    
    public function findArticleBorrowOut (Borrow $borrow , User $user=null)
    {


        $qb= $this->createQueryBuilder('a');
        $qb = $qb->select('a')
            ->innerJoin('a.user', 'u')
            ->innerJoin('u.borrows', 'b')
            ->innerJoin('b.article', 'ba')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('a.user' ,':currentuser'),
                $qb->expr()->eq('a.status', ':status')
                )

            )
//            ->where( 'user = :currentuser')
//            ->andWhere('a.status = :status' )
            ->setParameter(':currentuser', $user->getId())
            

             ;
        return $qb->setParameter(':status', $borrow->getId())
            ->getQuery()
            ->getResult();

      
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
