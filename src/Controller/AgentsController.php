<?php

namespace App\Controller;

use App\Entity\Agents;
use App\Form\AgentType;
use App\Repository\AgentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin")
 */
class AgentsController extends AbstractController
{
    /**
     * @Route("/agents", name="agents")
     * 
     */
    public function index(AgentsRepository $agentsRepository): Response
    {
        $agents = $agentsRepository->findAll();
    
        return $this->render('agents/index.html.twig', [
           'items'=> $agents,
           'type'=>'agent',
        ]);
    }

    /**
     * @Route("/add-agent" , name="add-agent")
     */
    public function addAgent(Request $request): Response
    {
        $agent = new Agents;
        $form = $this->createForm(AgentType::class,$agent);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $entityManager = $this->getdoctrine()->getManager();
                $entityManager->persist($agent);
                $entityManager->flush();
                return $this->redirectToRoute("agents");
            }

            
        
        
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'agent',
           'function'=>'Creer'
        ]);
    }


/**
     * @Route("/edit-agent/{id}" , name="edit-agent")
     */
    public function editAgent($id ,Request $request, AgentsRepository $agentsRepository): Response
    {
        $agent = $agentsRepository->find($id);
        $form = $this->createForm(AgentType::class,$agent);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getdoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute("agents");
        }

            
        return $this->render('form-item.html.twig', [
           'form'=>$form->createView(),
           'type'=>'agent',
           'function'=>'Editer'
        ]);
    }
}
