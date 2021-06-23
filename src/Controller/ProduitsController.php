<?php

namespace App\Controller;


use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("boutique")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="boutique", methods={"GET"})
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        $produit = $produitsRepository->findAll();

        return $this->render('pages/boutique.html.twig', [
            'produits' => $produit,
            'current_menu' => "boutique"
        ]);
    }

}