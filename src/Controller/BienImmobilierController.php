<?php

namespace App\Controller;

use App\Entity\BienImmobilier;
use App\Form\BienImmobilierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienImmobilierController extends AbstractController
{
    #[Route('/', name: 'bien.liste')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data['biens'] = $em->getRepository(BienImmobilier::class)->findAll();

        return $this->render('accueil.html.twig', $data);
    }

    #[Route('/bien/new', name: 'bien.new')]
    public function new(Request $request): Response
    {
        $bi = new BienImmobilier();
        $form = $this->createForm(BienImmobilierType::class, $bi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //----------------
            //   $userId = $this->getUser()->getId();
            //$bi->setUsers($this->getUser());
            //---------------

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bi);
            $entityManager->flush();

            return $this->redirectToRoute('bien.liste');
        }
        return $this->render('bien_immobilier/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/bien/{id}', name: 'bien.edit', methods:'GET|POST')]
    public function edit(Request $request, BienImmobilier $bi): Response
    {
        $form = $this->createForm(BienImmobilierType::class, $bi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('bien.liste');
        }
        return $this->render('bien_immobilier/edit.html.twig', [
            'bi' => $bi,
            'form' => $form->createView()
        ]);
    }

    #[Route('/bien/{id}', name: 'bien.delete', methods:'DELETE')]
    public function delete(BienImmobilier $bi)
    {
        $em = $this->getDoctrine()->getManager();
        $this->em->remove($bi);
        $this->em->flush();
        return $this->redirectToRoute('bien.liste');
    }


}
