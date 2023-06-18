<?php

namespace App\Controller;

use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BezoekerController extends AbstractController
{
    #[Route('/bezoeker', name: 'app_bezoeker')]
    public function index(): Response
    {
        return $this->render('bezoeker/index.html.twig', [
            'controller_name' => 'BezoekerController',
        ]);
    }
    #[Route('/trainingsaanbod', name: 'app_trainingsaanbod')]
    public function trainingsaanbod(TrainingRepository $trainingRepository): Response
    {
        $trainings = $trainingRepository->findall();
        return $this->render('bezoeker/trainingsaanbod.html.twig', [
            'trainings' => $trainings,
        ]);
    }
    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        
        return $this->render('bezoeker/contact.html.twig');
    }
    #[Route('/gedragsregels', name: 'app_gedragsregels ')]
    public function gedragsregels(): Response
    {
        
        return $this->render('bezoeker/gedragsregels.html.twig');
    }
}
