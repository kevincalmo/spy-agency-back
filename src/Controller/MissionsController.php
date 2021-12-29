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
            $request->query->getInt('page', 1),
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

            /*========== Phase de test des difféérentes données  ==========*/



            /* Les agents et les cibles sont de nationalités différentes */
            /* il faut assigner au moins un agent avec la spécialité demandé dans la mission */
            $nbr_agent_with_speciality = 0;
            $nbr_agents_targets_same_nationality = 0;
            foreach ($mission->getAgents() as $agent) {
                foreach ($mission->getTargets() as $target) {
                    if ($agent->getCountry() === $target->getCountry()) {
                        $nbr_agents_targets_same_nationality++;
                    }
                }
                if ($mission->getSpecialitys()->count() === 1) {
                    dump("ok");
                    foreach ($mission->getSpecialitys() as $missionSpecility) {
                        dump($missionSpecility->getName());
                        foreach ($agent->getSpecialitys() as $agentSpeciality) {
                            if ($missionSpecility->getName() === $agentSpeciality->getName()) {
                                $nbr_agent_with_speciality++;
                            }
                        }
                    }
                }
            }
            if ($mission->getSpecialitys()->count() > 1) array_push($errorsForm, "Vous ne pouvez choisir qu'une seule spécialité pour la mission");
            if ($nbr_agents_targets_same_nationality === 0) array_push($errorsForm, 'Les agents et les cibles ne peuvent avoir la même nationalité, veuillez changer d\'agents ou de cibles!');
            if ($nbr_agent_with_speciality === 0 && $mission->getSpecialitys()->count() === 1) array_push($errorsForm, "Aucun agent sélectionné ne possède la spécialité requise pour cette mission");

            /* les contacts sont obligatoirement de la nationalité de la mission */
            $nbr_contact = 0;
            foreach ($mission->getContacts() as $contact) {
                if ($contact->getCountry() !== $mission->getCountry()) $nbr_contact++;
            }
            if ($nbr_contact > 0) array_push($errorsForm, "Veuillez choisir des contacts ayant la nationalité du lieu me mission");

            /* Les planques sont obilgatoirement dans le même pays que la mission */
            $nbr_stashs = 0;
            foreach ($mission->getStashs() as $stash) {
                if ($stash->getCountry() !== $mission->getCountry()) $nbr_stashs++;
            }
            if ($nbr_stashs > 0) array_push($errorsForm, "Veuillez choisir des planques présentent dans le pays de mission");

            dump($errorsForm);
            if (empty($errorsForm)) {
                dump("La copie est propre");
                /* $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($mission);
                $entityManager->flush();
                return $this->redirectToRoute("missions"); */
            }
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
