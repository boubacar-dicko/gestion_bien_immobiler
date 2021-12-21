<?php

namespace App\Controller;

use App\Entity\AgenceImmobilier;
use App\Form\AgenceImmobilierType;
use App\Repository\AgenceImmobilierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agence/immobilier')]
class AgenceImmobilierController extends AbstractController
{
    #[Route('/', name: 'agence_immobilier_index', methods: ['GET'])]
    public function index(AgenceImmobilierRepository $agenceImmobilierRepository): Response
    {
        return $this->render('agence_immobilier/index.html.twig', [
            'agence_immobiliers' => $agenceImmobilierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'agence_immobilier_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $agenceImmobilier = new AgenceImmobilier();
        $form = $this->createForm(AgenceImmobilierType::class, $agenceImmobilier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agenceImmobilier);
            $entityManager->flush();

            return $this->redirectToRoute('agence_immobilier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agence_immobilier/new.html.twig', [
            'agence_immobilier' => $agenceImmobilier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agence_immobilier_show', methods: ['GET'])]
    public function show(AgenceImmobilier $agenceImmobilier): Response
    {
        return $this->render('agence_immobilier/show.html.twig', [
            'agence_immobilier' => $agenceImmobilier,
        ]);
    }

    #[Route('/{id}/edit', name: 'agence_immobilier_edit', methods: ['GET','POST'])]
    public function edit(Request $request, AgenceImmobilier $agenceImmobilier): Response
    {
        $form = $this->createForm(AgenceImmobilierType::class, $agenceImmobilier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_immobilier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agence_immobilier/edit.html.twig', [
            'agence_immobilier' => $agenceImmobilier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agence_immobilier_delete', methods: ['POST'])]
    public function delete(Request $request, AgenceImmobilier $agenceImmobilier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agenceImmobilier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agenceImmobilier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agence_immobilier_index', [], Response::HTTP_SEE_OTHER);
    }
}
