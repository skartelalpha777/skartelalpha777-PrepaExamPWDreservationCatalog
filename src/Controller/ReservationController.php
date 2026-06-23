<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\RepresentationReservation;
use App\Entity\Show;
use App\Form\ReservationType;
use App\Form\ReservationTypeAdmin;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/reservation')]
final class ReservationController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route(name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/{id}/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Show $show): Response
    {
        if ($show->getRepresentations()->getValues() == null) {
            $this->addFlash('notice', 'Aucune represenation n\'est prevu pour ce specatcle, Revenez plus tard');
            return $this->redirectToRoute('app_show_show', ['id' => $show->getId()], Response::HTTP_SEE_OTHER);
        }

     //   $rp = new RepresentationReservation();
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation, [
            'representations' => $show->getRepresentations(), //-> On envoi la liste pré-filtrée des represenations pour chercher dans la DB
            // Ainsi dans le formulaire affichera que les répresentations liées au Show courant lors de la reservation
            'prices' => $show->getPrices(), //-> On envoi la liste pré-filtrée des Prix pour chercher dans la DB, 
            //Ainsi on affiche que les prix liés au Show courant lors de la reservation pour un Show 
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setUser($this->getUser());
            $entityManager->persist($reservation);
            $quantity = $form->get('quantity')->getData();
            $selectedRepresentations = $form->get('representations')->getData();
            $selectedPrice = $form->get('price')->getData();

            foreach ($selectedRepresentations as $representation) {
                $rp = new RepresentationReservation();
                $rp->setQuantity($quantity);
                $rp->setReservation($reservation);
                $rp->setRepresentation($representation);

                // dd($representation->getPrice());

                foreach ($selectedPrice as $price) {
                    $rp->setPrice($price);
                }
                $entityManager->persist($rp);
            }

            $entityManager->flush();
            $this->addFlash('notice', 'Votre reservation a bien été prise en compte. Vous trouverai ci-dessous la liste de vos réservation');

            return $this->redirectToRoute('app_user_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        // dd($this->getUser());
        $form = $this->createForm(ReservationTypeAdmin::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reservation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
