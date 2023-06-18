<?php

namespace App\Controller;

use finfo;
use App\Entity\User;
use App\Entity\Lessen;
use App\Form\LessenType;
use App\Entity\Registration;
use App\Form\InstructorFormType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\LessenRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RegistrationRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InstructorController extends AbstractController
{
    #[Route('/instructor', name: 'app_instructor')]
    public function index(): Response
    {
        return $this->render('instructor/index.html.twig', [
            'controller_name' => 'InstructorController',
        ]);
    }


    #[Route('instructor/lessen', name: 'app_lessen_index', methods: ['GET'])]
    public function instructorLessen(): Response
    {
        $lessens = $this->getuser()->getLessens();
        return $this->render('instructor/lessen/index.html.twig', [

            'lessens' => $lessens,
        ]);
    }


    #[Route('instructor/ledenlijst', name: 'app_ledenlijst',  methods: ['GET'])]
    public function ledenlijst(RegistrationRepository $repository,)
    {
        $members =$repository->findAll();
        dd($members);
        return $this->render('instructor/lessen/ledenlijst.html.twig', [
            'members' => $members
        ]);
    }

    #[Route('instructor/new', name: 'app_lessen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LessenRepository $lessenRepository): Response
    {
        $lessen = new Lessen();
        $form = $this->createForm(LessenType::class, $lessen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessen->setInstructor($this->getUser());
            $lessenRepository->save($lessen, true);

            return $this->redirectToRoute('app_lessen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instructor/lessen/new.html.twig', [
            'lessen' => $lessen,
            'form' => $form,
        ]);
    }

    #[Route('instructor/{id}/edit', name: 'app_lessen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lessen $lessen, LessenRepository $lessenRepository): Response
    {
        $form = $this->createForm(LessenType::class, $lessen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lessenRepository->save($lessen, true);

            return $this->redirectToRoute('app_lessen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instructor/lessen/edit.html.twig', [
            'lessen' => $lessen,
            'form' => $form,
        ]);
    }

    #[Route('instructor/{id}', name: 'app_lessen_delete', methods: ['POST'])]
    public function delete(Request $request, Lessen $lessen, LessenRepository $lessenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $lessen->getId(), $request->request->get('_token'))) {
            $lessenRepository->remove($lessen, true);
        }

        return $this->redirectToRoute('app_lessen_index', [], Response::HTTP_SEE_OTHER);
    }




    // #[Route('instructor/show', name: 'app_show_gegevens')]
    // public function showProfiel(): Response
    // {
    //     return $this->render('instructor/show-gegevens.html.twig');
    // }




    #[Route('/{id}/edit', name: 'app_instructor_edit')]
    public function instructorEdit(Request $request, $id, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();

        if ($user->getId() != $id) {

            return $this->redirect($this->generateUrl('app_instructor'));
        }

        $form = $this->createForm(InstructorFormType::class, $user);

        $form->add('update', SubmitType::class, array(
            'label' => 'update',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $userRepository->save($user, true);

            return $this->redirectToRoute('app_instructor');
        }

        return $this->renderForm('instructor/gegevens-aanpassen.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }

}
