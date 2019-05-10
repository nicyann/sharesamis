<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Borrow;
use App\Entity\GroupShare;
use App\Entity\Member;
use App\Entity\Status;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivityController extends AbstractController
{
    /**
     * @Route("/activity/borrow", name="activity_borrow")
     */
    public function index()
    {
        return $this->render('activity/prets.html.twig', [
            'controller_name' => 'ActivityController',
        ]);
    }
    
    
    
    /**
     * @Route("/activity/article", name="activity_article")
     */
    public function objets()
    {
        $repositoryA = $this->getDoctrine()->getRepository(Article::class);
        $repositoryB = $this->getDoctrine()->getRepository(Borrow::class);
        $status = $this->getDoctrine()->getRepository(Status::class)->findOneBy(['label'=>'En prêt']);
        $repositoryC = $this->getDoctrine()->getRepository(Article::class)->findArticleBorrowOut($status,$this->getUser());
        $member =$this->getDoctrine()->getRepository(Member::class)->find($this->getUser());
        
        $articles =$repositoryA->findBy([ 'user' => $this->getUser() ]);
        $countarticles = $repositoryA->count(['user' => $this->getUser()]);
        $countborrow = $repositoryB->count(['user' => $this->getUser(),'returned' => '0']);
        $countbBorrowOut =count($repositoryC);
        
        
        return $this->render('activity/objets.html.twig', [
            'articles' => $articles,
            'countarticles' => $countarticles,
            'countborrow' =>$countborrow,
            'countborrowout' =>$countbBorrowOut,
            'member' => $member
            
        ]);
    }
    
    /**
     *  @Route("/activity/borrow", name="activity_borrow")
     */
    
    public function borrow()
    {
        $repositoryA = $this->getDoctrine()->getRepository(Article::class);
        $status = $this->getDoctrine()->getRepository(Status::class)->findOneBy(['label'=>'En prêt']);
        
        $repositoryB = $this->getDoctrine()->getRepository(Borrow::class);
        $repositoryC = $this->getDoctrine()->getRepository(Article::class)->findArticleBorrowOut($status,$this->getUser());
        $member =$this->getDoctrine()->getRepository(Member::class)->find($this->getUser());
        
        $articles =$repositoryA->findBy([ 'user' => $this->getUser() ]);
        $countarticles = $repositoryA->count(['user' => $this->getUser()]);
        $countborrow = $repositoryB->count(['user' => $this->getUser(),'returned' => '0']);
        $countbBorrowOut =count($repositoryC);
        
       
        
        
        
        
        return $this->render('activity/prets.html.twig', [
            'articles' => $articles,
            'countarticles' => $countarticles,
            'countborrow' => $countborrow,
            'countborrowout' =>$countbBorrowOut,
            'member' => $member
            
            
        ]);

    }
}
