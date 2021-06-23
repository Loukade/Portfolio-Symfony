<?php

namespace App\Controller\Admin;


use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminRealisationController extends AbstractController
{
    /**
     * @param RealisationRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("admin/realisations", name ="admin.realisations.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RealisationRepository $realisationRepository)
    {
        $realisations = $realisationRepository->findAll();
        return $this->render('admin/realisation/index.html.twig', compact('realisations'));

    }

    /**
     * @param Realisation $realisation
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/realisation/edit/{id}", name ="admin.realisations.edit")
     */
    public function edit(Realisation $realisation, Request $request)
    {

        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.realisations.index');
        }

        return $this->render('admin/realisation/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView()
        ]);
    }
}