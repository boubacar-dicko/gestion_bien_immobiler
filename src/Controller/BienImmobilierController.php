<?php

namespace App\Controller;

use App\Entity\BienImmobilier;
use App\Entity\Contact;
use App\Entity\User;
use App\Form\BienImmobilierType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\equalTo;

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
              $userId = $this->getUser()->getId();
               $bi->setUser($this->getUser());
            //---------------


            $entityManager = $this->getDoctrine()->getManager();
            if($bi->getNomBien()== '0')
            { $bi->setNomBien('Immeuble');
            }elseif ($bi->getNomBien()== '1')
            {$bi->setNomBien('Appartement');
            }elseif ($bi->getNomBien()== '2'){
                $bi->setNomBien('Maison');
            }else{$bi->setNomBien('Magasin');}

            $entityManager->persist($bi);
            $entityManager->flush();

            return $this->redirectToRoute('bien.liste');
        }
        return $this->render('bien_immobilier/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/bien/{id}/edit', "methods={POST, GET}", name: 'bien.edit')]
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

    #[Route('/bien/{id}',"methods=DELETE", name: 'bien.delete',)]
    public function delete(Request $request, BienImmobilier $bi)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($bi);
            $em->flush();
        return $this->redirectToRoute('bien.liste');
    }


    #[Route('/bien/details/{id}', name: 'bien.show')]
    public function show(BienImmobilier $bi, Request $request, ContactNotification $notification): Response
    {
        $contact = new Contact();
        $contact->setBienImmobilier($bi);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $notification->notify($contact);
           /* return $this->redirectToRoute('bien.show', [
                'id' => $bi->getId()
            ]);*/
        }
        return $this->render('bien_immobilier/show.html.twig', [
            'bien' => $bi,
            'form' => $form->createView()
        ]);
    }


    #[Route('/vendre', name: 'bien.vendre')]
    public function vendre(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data['biens'] = $em->getRepository(BienImmobilier::class)->findBienAvendre();
        return $this->render('transaction/achat.html.twig', $data);
    }

    #[Route('/location', name: 'bien.location')]
    public function location(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data['biens'] = $em->getRepository(BienImmobilier::class)->findBienAlouer();
        return $this->render('transaction/location.html.twig', $data);
    }

    #[Route('/listeBienAgent', name: 'bien.agent')]
    public function listeBienAgent(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data['biens'] = $em->getRepository(BienImmobilier::class)->findAll();

        $userId = $this->getUser()->getId();
        foreach ($data as $k => $v)
        {
            foreach ($v as $value => $item)
            {
                if ($item->getUser()->getId() == $userId)
                {
                    $da['bi'] = $em->getRepository(BienImmobilier::class)->findBienById($item->getUser()->getId());
                    return $this->render('agentImmobilier/listeBien.html.twig', $da);
                }
            }
        }

        return $this->render('accueil.html.twig', $data);
    }
}
