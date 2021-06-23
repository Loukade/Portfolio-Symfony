<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("presentation")
 */
class PresentationController extends AbstractController
{
    /**
     * @Route("/", name="presentation", methods={"GET"})
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('pages/presentation.html.twig', [


            'current_menu' => "about"
        ]);
    }
}