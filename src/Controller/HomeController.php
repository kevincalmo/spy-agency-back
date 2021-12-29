<?php

namespace App\Controller;

use App\Repository\MissionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MissionsRepository $missionsRepository): Response
    {
        $missions = $missionsRepository->findAll();


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
