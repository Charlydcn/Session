<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(StagiaireRepository $stagiaireRepository): Response
    {
        $stagiaires = $stagiaireRepository->findBy([], ["nom" => "ASC"]);

        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    #[Route('/stagiaire/new', name: 'new_stagiaire')]
    // #[Route('/stagiaire/{id}/edit', name: 'edit_stagiaire')]
    public function new(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // if (!$stagiaire) {
            $stagiaire = new Stagiaire();
        // }
        
        // On créer le formulaire à partir du formType (stagiaireType)
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        //  On 'handle' la requête
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide,
        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère les données
            $stagiaire = $form->getData();
            // persist = prepare PDO
            $entityManager->persist($stagiaire);
            // flush = execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_stagiaire');
        }
        
        return $this->render('stagiaire/new.html.twig', [
            'addStagiaireForm' => $form,
            // 'edit' => $stagiaire->getId()
        ]);
    }

    #[Route('/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    public function delete(Stagiaire $stagiaire, EntityManagerInterface $entityManager) 
    {
        $entityManager->remove($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute('app_stagiaire');
    }


    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire): Response
    {   
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

}
