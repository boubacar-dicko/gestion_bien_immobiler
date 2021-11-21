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
    #[Route('/bien/liste', name: 'bien.liste')]
    public function index(): Response
    {
        return $this->render('bien_immobilier/index.html.twig', [
            'controller_name' => 'BienImmobilierController',
        ]);
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
}
