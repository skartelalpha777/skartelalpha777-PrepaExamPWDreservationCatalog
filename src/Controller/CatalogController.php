<?php

namespace App\Controller;

use App\Entity\Catalog;
use App\Form\CatalogType;
use App\Form\CatalogTypeAdmin;
use App\Repository\CatalogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/catalog')]
final class CatalogController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route(name: 'app_catalog_index', methods: ['GET'])]
    public function index(CatalogRepository $catalogRepository): Response
    {
        return $this->render('catalog/index.html.twig', [
            'catalogs' => $catalogRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_catalog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $catalog = new Catalog();
        $form = $this->createForm(CatalogType::class, $catalog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($catalog);
            $entityManager->flush();

            return $this->redirectToRoute('app_catalog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('catalog/new.html.twig', [
            'catalog' => $catalog,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_catalog_show', methods: ['GET'])]
    public function show(Catalog $catalog): Response
    {
        //dd($catalog->getShows()->getValues());
        return $this->render('catalog/show.html.twig', [
            'catalog' => $catalog,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/show', name: 'app_catalog_new_show', methods: ['GET', 'POST'])]
    public function newShow(Request $request, Catalog $catalog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatalogTypeAdmin::class, $catalog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'les spectacles ont bien été mis a jour ');
            return $this->redirectToRoute('app_catalog_show', ['id'=>$catalog->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('catalog/newShow.html.twig', [
            'catalog' => $catalog,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_catalog_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Catalog $catalog, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CatalogType::class, $catalog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_catalog_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('catalog/edit.html.twig', [
            'catalog' => $catalog,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_catalog_delete', methods: ['POST'])]
    public function delete(Request $request, Catalog $catalog, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $catalog->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($catalog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_catalog_index', [], Response::HTTP_SEE_OTHER);
    }
}
