<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Form\RepresentationType;
use App\Repository\RepresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/representation')]
final class RepresentationController extends AbstractController
{
    #[isGranted('ROLE_ADMIN')]
    #[Route(name: 'app_representation_index', methods: ['GET'])]
    public function index(RepresentationRepository $representationRepository): Response
    {
        return $this->render('representation/index.html.twig', [
            'representations' => $representationRepository->findAll(),
        ]);
    }

    #[isGranted('ROLE_PRODUCTEUR')] // L'amin heirite du role producteur donc il peut acceder a cette page
    #[Route('/new', name: 'app_representation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $representation = new Representation();
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($representation);
            $entityManager->flush();

            return $this->redirectToRoute('app_representation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('representation/new.html.twig', [
            'representation' => $representation,
            'form' => $form,
        ]);
    }
    #[isGranted('ROLE_ADMIN')]
    #[Route('/{id<\d+>}', name: 'app_representation_show', methods: ['GET'])]
    public function show(Representation $representation): Response
    {
        return $this->render('representation/show.html.twig', [
            'representation' => $representation,
        ]);
    }
    #[isGranted('ROLE_ADMIN')]
    #[Route('/{id<\d+>}/edit', name: 'app_representation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Representation $representation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_representation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('representation/edit.html.twig', [
            'representation' => $representation,
            'form' => $form,
        ]);
    }
    #[isGranted('ROLE_ADMIN')]
    #[Route('/{id<\d+>}', name: 'app_representation_delete', methods: ['POST'])]
    public function delete(Request $request, Representation $representation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $representation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($representation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_representation_index', [], Response::HTTP_SEE_OTHER);
    }
}
