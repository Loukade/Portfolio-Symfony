<?php

namespace App\Controller;

use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("realisations")
 */
class RealisationController extends AbstractController
{
    /**
     * @Route("/", name="realisation", methods={"GET"})
     */
    public function index(RealisationRepository $realisationRepository): Response
    {
        $realisations = $realisationRepository->findAll();
        return $this->render('pages/realisation.html.twig', [
            'realisations' => $realisations,
            'current_menu' => "realisation"
        ]);
    }

}