<?php

namespace App\Controller;

use App\Entity\GroupShare;
use App\Form\GroupShareType;
use App\Repository\GroupShareRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @Route("/group")
 */
class GroupShareController extends AbstractController
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
     * @Route("/", name="group_share_index", methods={"GET"})
     */
    public function index(  ): Response
    {
        $groupshares = $this->repository->findGroupmember();
    
        return $this->render('groupes/index.html.twig',[
            'current_menu' => 'groups',
            'groupshares' => $groupshares
    
        ]);
    }


    /**
     * @Route("/new", name="group_share_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $groupShare = new GroupShare();
        $form = $this->createForm(GroupShareType::class, $groupShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupShare);
            $entityManager->flush();

            return $this->redirectToRoute('group_share_index');
        }

        return $this->render('group_share/new.html.twig', [
            'group_share' => $groupShare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="group_share_show", methods={"GET"})
     */
    public function show(GroupShare $groupShare): Response
    {
        return $this->render('group_share/show.html.twig', [
            'group_share' => $groupShare,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="group_share_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GroupShare $groupShare): Response
    {
        $form = $this->createForm(GroupShareType::class, $groupShare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_share_index', [
                'id' => $groupShare->getId(),
            ]);
        }

        return $this->render('group_share/edit.html.twig', [
            'group_share' => $groupShare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="group_share_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GroupShare $groupShare): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupShare->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupShare);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_share_index');
    }
}
