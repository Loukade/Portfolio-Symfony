<?php

namespace App\Controller;

use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("experience")
 */
class ExperienceController extends AbstractController
{
    /**
     * @Route("/", name="experience", methods={"GET"})
     * @param ExperienceRepository $realisationRepository
     * @return Response
     */
    public function index(ExperienceRepository $realisationRepository): Response
    {
        $experience = $realisationRepository->findAll();

        return $this->render('pages/experience.html.twig', [
            'experiences' => $experience,
            'current_menu' => "experience"
        ]);
    }
}