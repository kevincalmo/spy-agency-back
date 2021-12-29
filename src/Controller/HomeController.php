<?php

namespace App\Controller;

use App\Repository\MissionsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MissionsRepository $missionsRepository, Request $request, PaginatorInterface $paginatorInterface): Response
    {
        $donnees = $missionsRepository->findAll();

        $missions = $paginatorInterface->paginate(
            $donnees,
            $request->query->getInt('page',1),//numéro de la page en cours, 1 par défaut
            1
        );


        return $this->render('home/index.html.twig', [
            'items' => $missions,
            'type' => 'mission'
        ]);
    }

    /**
     * @Route("/mission/{id}" ,name="detail-mission")
     */
    public function detailMission($id, MissionsRepository $missionsRepository)
    {

        $mission = $missionsRepository->find($id);
        dump($mission);


        return $this->render('home/detail-mission.html.twig',[
             'mission'=>$mission, 
        ]);

    }
}
