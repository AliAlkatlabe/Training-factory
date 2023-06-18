<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Lessen;
use App\Entity\Registration;
use Doctrine\ORM\EntityManager;
use App\Form\InstructorFormType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\LessenRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RegistrationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function index(): Response
    {
        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }


    #[Route('member/lessen', name: 'lessen')]
    public function lessesn(LessenRepository $lessenRepository): Response
    {
        // $user = $this->getUser();

        $lessens = $lessenRepository->findAllLessons($this->getUser());
        //$lessens = $lessenRepository->findBy(['member' => $this->getUser()]);
        //dd($lessens);

        return $this->render('member/lessen.html.twig', [
            'lessens' =>  $lessens,
        ]);
    }

    #[Route('member/inschrijven{id}', name: 'inschrijven')]
    public function inschrijven(Lessen $lessen, ManagerRegistry $managerRegistry, EntityManagerInterface $em): Response
    {

        $em = $managerRegistry->getManager();
        $registration = new Registration();
        $registration->setPayment(false);
        $registration->setLesson($lessen);
        $registration->setMember($this->getUser());
        $em->persist($registration);
        $em->flush();



        return $this->redirectToRoute('lessen');
    }


    #[Route('member/inschrijvingen', name: 'inschrijvingen')]
    public function inschrijvingen(UserInterface $user): Response
    {

        $user = $this->getuser()->getRegistrations();

        return $this->render('member/inschrijvingen.html.twig', [

            'user' => $user,

        ]);
    }


    #[Route('member/uitschrijven{id}', name: 'uitschrijven')]
    public function uitschrijven(RegistrationRepository $registrationRepository, ManagerRegistry $managerRegistry, EntityManagerInterface $em, $id): Response
    {

        $registrations = $registrationRepository->find($id);
        $em = $managerRegistry->getManager();
        $em->remove($registrations);
        $em->flush();

        return $this->redirectToRoute('inschrijvingen');
    }




    // #[Route('member/show', name: 'app_show_profiel')]
    // public function showProfiel(): Response
    // {
    //     return $this->render('member/showProfiel.html.twig');
    // }




    #[Route('member/{id}/edit', name: 'app_member_edit')]
    public function editProfiel(Request $request, $id, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();

        if ($user->getId() != $id) {

            return $this->redirect($this->generateUrl('app_member'));
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

            return $this->redirectToRoute('app_member');
        }

        return $this->renderForm('member/editProfiel.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }
}
