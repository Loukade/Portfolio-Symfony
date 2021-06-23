<?php

namespace App\Controller\Admin;


use App\Entity\Produits;
use App\Form\ProduitType;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminProduitController extends AbstractController
{
    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("admin/produits", name ="admin.produits.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProduitsRepository $produitsRepository)
    {
        $produits = $produitsRepository->findAll();
        return $this->render('admin/produit/index.html.twig', compact('produits'));

    }

    /**
     * @param Produits $produit
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/produits/edit/{id}", name ="admin.produits.edit")
     */
    public function edit(Produits $produit, Request $request)
    {

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.produits.index');
        }

        return $this->render('admin/produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }
}