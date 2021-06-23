<?php

namespace App\Controller\Admin;


use App\Entity\Presentation;
use App\Form\PresentationType;
use App\Repository\PresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPresentationController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AdminPresentationController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("admin/presentations", name ="admin.presentations.index")
     * @return Response
     */
    public function index(PresentationRepository $presentationRepository)
    {
        $presentations = $presentationRepository->findAll();
        return $this->render('admin/presentation/index.html.twig', compact('presentations'));

    }

    /**
     * @param Presentation $presentation
     * @param Request $request
     * @return Response
     * @Route("/admin/presentations/edit/{id}", name ="admin.presentations.edit")
     */
    public function edit(Presentation $presentation, Request $request)
    {

        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('admin.presentations.index');
        }

        return $this->render('admin/presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form->createView()
        ]);
    }
}