<?php

namespace  App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GroupController extends AbstractController
{
    /**
     * @Route("/group",  name="group_index")
     * @return Response
     */
    public function index(): Response
    {
        return new Response('Les groupes');
    }
    
    
}
