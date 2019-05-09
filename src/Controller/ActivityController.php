<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Borrow;
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
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles =$repository->findBy([ 'user' => $this->getUser() ]);
        $countarticles = $repository->count(['user' => $this->getUser()]);
        
        return $this->render('activity/objets.html.twig', [
            'articles' => $articles,
            'countarticles' => $countarticles
        ]);
    }
    
    /**
     *  @Route("/activity/borrow", name="activity_borrow")
     */
    
    public function borrow()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles =$repository->findBy([ 'user' => $this->getUser() ]);
        $countarticles = $repository->count(['user' => $this->getUser()]);
        
        return $this->render('activity/prets.html.twig', [
            'articles' => $articles,
            'countarticles' => $countarticles
        ]);

    }
}
