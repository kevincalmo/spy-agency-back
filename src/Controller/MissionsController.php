<?php

namespace App\Controller;

use App\Entity\Missions;
use App\Form\MissionType;
use App\Repository\AgentsRepository;
use App\Repository\MissionsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class MissionsController extends AbstractController
{
    /**
     * @Route("/missions", name="missions")
     */
    public function index(MissionsRepository $missionsRepository, Request $request, PaginatorInterface $paginatorInterface): Response
    {

        $donnees = $missionsRepository->findAll();

        $missions = $paginatorInterface->paginate(
            $donnees,
            $request->query->getInt('page',1),
            10
        );


        return $this->render('missions/index.html.twig', [
            'items' => $missions,
            'type' => 'mission'
        ]);
    }

    /**
     * @Route("/add-mission" , name="add-mission")
     */
    public function addMission(Request $request, AgentsRepository $agentsRepository): Response
    {
        $mission = new Missions;
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);
        $errorsForm = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->persist($mission);
            $entityManager->flush();
            return $this->redirectToRoute("missions");
        }

        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'mission',
            'function' => 'Creer',
            'errorsValidation' => $errorsForm,
        ]);
    }

    /**
     * @Route("/edit-mission/{id}" , name="edit-mission")
     */
    public function editAgent($id, Request $request, MissionsRepository $missionsRepository): Response
    {
        $mission = $missionsRepository->find($id);
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("missions");
        }


        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'mission',
            'function' => 'Editer'
        ]);
    }
}