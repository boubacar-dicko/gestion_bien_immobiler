<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContratController extends AbstractController
{
    #[Route('/contrat/liste', name: 'contrat.liste')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository(Contrat::class)->findAll();
        return $this->render('contrat/index.html.twig', [
            'contrats'=> $con
        ]);
    }

    #[Route('/contrat/new', name: 'contrat.new')]
    public function new(Request $request): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            if($contrat->getTransaction()== '0')
            { $contrat->setTransaction('OrangeMoney');
            }elseif ($contrat->getTransaction()== '1')
            {$contrat->setTransaction('Wave');
            }elseif ($contrat->getTransaction()== '2'){
                $contrat->setTransaction('Espece');
            }else{$contrat->setTransaction('Cheque');}

            $entityManager->persist($contrat);
            $entityManager->flush();
            return $this->redirectToRoute('contrat.liste');
        }
        return $this->render('contrat/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/contrat/edit/{id}', name: 'contrat.edit')]
    public function edit(Request $request): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            if($contrat->getTransaction()== '0')
            { $contrat->setTransaction('OrangeMoney');
            }elseif ($contrat->getTransaction()== '1')
            {$contrat->setTransaction('Wave');
            }elseif ($contrat->getTransaction()== '2'){
                $contrat->setTransaction('Espece');
            }else{$contrat->setTransaction('Cheque');}

            $entityManager->flush();
            return $this->redirectToRoute('contrat.liste');
        }
        return $this->render('contrat/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
