<?php

namespace App\Controller;


use App\Repository\ParcoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("parcours")
 */
class ParcoursController extends AbstractController
{
    /**
     * @Route("/", name="parcours", methods={"GET"})
     */
    public function index(ParcoursRepository $parcoursRepository): Response
    {
        $parcours = $parcoursRepository->findAll();
        return $this->render('pages/parcours.html.twig', [
            'parcours' => $parcours,
            'current_menu' => "parcour"
        ]);
    }

}