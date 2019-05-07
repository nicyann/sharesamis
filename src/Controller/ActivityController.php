<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function home()
    {
        return $this->render('activity/objets.html.twig', [
            'controller_name' => 'ActivityController',
        ]);
    }
}
