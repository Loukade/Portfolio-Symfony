<?php

namespace App\Controller\Admin;


use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminExperienceController extends AbstractController
{
 /**
       * @param ExperienceRepository $repository
       * @param EntityManagerInterface $em
       */
      public function __construct(EntityManagerInterface $em)
      {
          $this->em = $em;
      }

      /**
       * @Route("admin/experiences", name ="admin.experiences.index")
       * @return \Symfony\Component\HttpFoundation\Response
       */
      public function index(ExperienceRepository $experiencesRepository)
      {
          $experiences = $experiencesRepository->findAll();
          return $this->render('admin/experience/index.html.twig', compact('experiences'));

      }

      /**
       * @param Experience $experience
       * @param Request $request
       * @return \Symfony\Component\HttpFoundation\Response
       * @Route("/admin/experience/edit/{id}", name ="admin.experiences.edit")
       */
      public function edit(Experience $experience, Request $request)
      {

          $form = $this->createForm(ExperienceType::class, $experience);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $this->em->flush();
              return $this->redirectToRoute('admin.experiences.index');
          }

          return $this->render('admin/experience/edit.html.twig', [
              'experience' => $experience,
              'form' => $form->createView()
          ]);
      }
  }