<?php

namespace App\Controller\Admin;


use App\Entity\Parcours;
use App\Form\ParcourType;
use App\Repository\ParcoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AdminParcourController extends AbstractController
{
    /**
     * AdminParcoursController constructor.
     * @param ParcoursRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("admin/parcours", name ="admin.parcours.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ParcoursRepository $parcoursRepository)
    {
        $parcours = $parcoursRepository->findAll();
        return $this->render('admin/parcour/index.html.twig', compact('parcours'));

    }

    /**
     * @param Parcours $parcour
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/parcours/edit/{id}", name ="admin.parcours.edit")
     */
    public function edit(Parcours $parcour, Request $request)
    {

        $form = $this->createForm(ParcourType::class, $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.parcours.index');
        }

        return $this->render('admin/parcour/edit.html.twig', [
            'parcour' => $parcour,
            'form' => $form->createView()
        ]);
    }
}