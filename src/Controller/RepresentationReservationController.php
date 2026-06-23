<?php

namespace App\Controller;

use App\Entity\RepresentationReservation;
use App\Form\RepresentationReservationType;
use App\Repository\RepresentationReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/representation/reservation')]
final class RepresentationReservationController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route(name: 'app_representation_reservation_index', methods: ['GET'])]
    public function index(RepresentationReservationRepository $representationReservationRepository): Response
    {
        return $this->render('representation_reservation/index.html.twig', [
            'representation_reservations' => $representationReservationRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_PRODUCTEUR')]
    #[Route('/new', name: 'app_representation_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $representationReservation = new RepresentationReservation();
        $form = $this->createForm(RepresentationReservationType::class, $representationReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($representationReservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_representation_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('representation_reservation/new.html.twig', [
            'representation_reservation' => $representationReservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_representation_reservation_show', methods: ['GET'])]
    public function show(RepresentationReservation $representationReservation): Response
    {
        return $this->render('representation_reservation/show.html.twig', [
            'representation_reservation' => $representationReservation,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_representation_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RepresentationReservation $representationReservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RepresentationReservationType::class, $representationReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_representation_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('representation_reservation/edit.html.twig', [
            'representation_reservation' => $representationReservation,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_representation_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, RepresentationReservation $representationReservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $representationReservation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($representationReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_representation_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
