<?php

namespace App\Controller;

use App\Repository\GroupShareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

Class DefaultController extends AbstractController
{
    
    
    /**
     * @Route("/" , name="index")
     * @param GroupShareRepository $repository
     * @return Response
     */
    public function index(GroupShareRepository $repository): Response
    {
        $groupshare =$repository->find(21);
        dump($groupshare);
        return $this->render('default\index.html.twig',[
            'groupshare'=> $groupshare
            
        ]);
    }
    
}