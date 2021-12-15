<?php

namespace App\Controller;

use App\Entity\BienImmobilier;
use App\Entity\BienSearch;
use App\Entity\Contact;
use App\Entity\Images;
use App\Entity\User;
use App\Form\BienImmobilierType;
use App\Form\BienSearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\BienImmobilierRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\equalTo;


class BienImmobilierController extends AbstractController
{
    #[Route('/', name: 'bien.liste')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $search);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $biens = $paginator->paginate(
                        $em->getRepository(BienImmobilier::class)->findAllVisibleQuery($search),
                        $request->query->getInt('page',1),
                        6);

        return $this->render('accueil.html.twig', [
                'biens' => $biens,
                'form' => $form->createView()
            ]

        );
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
            //On recupere les images transmises
            $images = $form->get('images')->getData();
           // on boucle sur les images
            foreach($images as$image )
            {
                // on genere un nouveau nom de fichier
                $fichier = md5(uniqid()). '.' . $image->guessExtension();
                //on copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stocke l'image dans base de donnees (son nom)
                $img = new Images();
                $img->setName($fichier);
                $bi->addImage($img);
            }
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
            //On recupere les images transmises
            $images = $form->get('images')->getData();
            // on boucle sur les images
            foreach($images as$image )
            {
                // on genere un nouveau nom de fichier
                $fichier = md5(uniqid()). '.' . $image->guessExtension();
                //on copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stocke l'image dans base de donnees (son nom)
                $img = new Images();
                $img->setName($fichier);
                $bi->addImage($img);
            }

            if($bi->getNomBien()== '0')
            { $bi->setNomBien('Immeuble');
            }elseif ($bi->getNomBien()== '1')
            {$bi->setNomBien('Appartement');
            }elseif ($bi->getNomBien()== '2'){
                $bi->setNomBien('Maison');
            }else{$bi->setNomBien('Magasin');}

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
    public function show(BienImmobilier $bi, Request $request, ContactNotification $notification, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $contact->setBienImmobilier($bi);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        // On cherche l'agent administrateur de ce bien
        $user_id =$bi->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $agent = $em->getRepository(User::class)->findAll();
        foreach ($agent as $k => $v)
        {
            if ($v->getId() == $user_id)
            {
                $user = $em->getRepository(User::class)->findUserById($v->getId());
                foreach ($user as $k => $v)
                {
                    $myUser = $v;
                }
            }
        }
        if ($form->isSubmitted() && $form->isValid())
        {
            //$notification->notify($contact);
            $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('testdickogueye@gmail.com')
                ->subject('Message d\'un client')
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'mail' => $contact->getEmail(),
                    'message'=> $contact->getMessage()
                ]);
            $mailer->send($email);
          return $this->redirectToRoute('bien.show', [
                'id' => $bi->getId()
            ]);
        }
        return $this->render('bien_immobilier/show.html.twig', [
            'bien' => $bi,
            'myUser' => $myUser,
            'form' => $form->createView()
        ]);
    }


    #[Route('/vendre', name: 'bien.vendre')]
    public function vendre(PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$data['biens'] = $em->getRepository(BienImmobilier::class)->findBienAvendre();
        $data['biens'] = $paginator->paginate(
            $em->getRepository(BienImmobilier::class)->findBienAvendre(),
            $request->query->getInt('page',1),
            3);
        return $this->render('transaction/achat.html.twig', $data);
    }

    #[Route('/location', name: 'bien.location')]
    public function location(PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$data['biens'] = $em->getRepository(BienImmobilier::class)->findBienAlouer();
        $data['biens'] = $paginator->paginate(
            $em->getRepository(BienImmobilier::class)->findBienAlouer(),
            $request->query->getInt('page',1),
            3);
        return $this->render('transaction/location.html.twig', $data);
    }

    #[Route('/liste/Biens/Agent', name: 'bien.agent')]
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

    #[Route('/bien/supprime/image/{id}',"methods=DELETE", name: 'bien.delete.image',)]
    public function deleteImage(Images $images, Request $request){
        $data = json_decode($request->getContent(), true);
        // On verifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$images->getId(), $data['_token'])){
            // On recupere le nom de l'image
            $nom = $images->getName();
            // On supprime l'image
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($images);
            $em->flush();

            // On repond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
