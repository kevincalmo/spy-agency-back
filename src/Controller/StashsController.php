<?php

namespace App\Controller;

use App\Entity\Stashs;
use App\Form\StashType;
use App\Repository\StashsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class StashsController extends AbstractController
{
    /**
     * @Route("/stashs", name="stashs")
     */
    public function index(StashsRepository $stashsRepository): Response
    {
        $stashs = $stashsRepository->findAll();

        return $this->render('stashs/index.html.twig', [
            'items'=>$stashs,
            'type'=>'stash',
        ]);
    }

    /**
     * @Route("/add-stash" , name="add-stash")
     */
    public function addAgent(Request $request): Response
    {
        $stash = new Stashs;
        $form = $this->createForm(StashType::class,$stash);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($stash);
                $entityManager->flush();
                return $this->redirectToRoute("stashs");
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'stash',
           'function'=>'Creer'
        ]);
    }

    /**
     * @Route("/edit-stash/{id}" , name="edit-stash")
     */
    public function editAgent($id ,Request $request, StashsRepository $stashsRepository): Response
    {
        $stash = $stashsRepository->find($id);
        $form = $this->createForm(StashType::class,$stash);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("stashs");
        }

            
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'stash',
           'function'=>'Editer'
        ]);
    }

}