<?php

namespace App\Controller;

use App\Entity\Administrator;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\AdministratorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(AdministratorRepository $administratorRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {

        $donnees = $administratorRepository->findAll();
        $users = $paginatorInterface->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('users/index.html.twig', [
            'items' => $users,
            'type' => 'user',
        ]);
    }

    /**
     * @Route("/add-user",name="add-user")
     */
    public function addUser(Request $request)
    {
        $user = new Administrator();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('users');
        }

        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'user',
            'function' => 'creer'
        ]);
    }

    /**
     * @Route("/edit-user/{id}", name="edit-user")
     */
    public function editUser($id, Request $request, UserPasswordEncoderInterface $passwordEncoder ,AdministratorRepository $administratorRepository): Response
    {
        $user = $administratorRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('users');
        }

        return $this->render('form-item.html.twig', [
            'form' => $form->createView(),
            'type' => 'user',
            'function' => 'Editer'
        ]);
    }
}
