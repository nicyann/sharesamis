<?php

namespace  App\Controller;

use App\Entity\GroupShare;
use App\Repository\GroupShareRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GroupshareController extends AbstractController
{
    
    
    /**
     * @var GroupShareRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;
    
    public function __construct(GroupShareRepository $repository, ObjectManager $em)
    {
    
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/group",  name="group_index")
     * @return Response
     */
    public function index(): Response
    {
        $groupshares = $this->repository->findGroupmember();
 
        return $this->render('groupes/index.html.twig',[
            'current_menu' => 'groups',
            'groupshares' => $groupshares
            
        ]);
    }
    
    
}
