<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(FormationRepository $formationRepository): Response
    {
        $formations = $formationRepository->findBy([], ["intitule" => "ASC"]);

        return $this->render('session/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    // #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // if (!$session) {
            $session = new Session();
        // }
        
        // On créer le formulaire à partir du formType (sessionType)
        $form = $this->createForm(SessionType::class, $session);

        //  On 'handle' la requête
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide,
        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère les données
            $session = $form->getData();
            // persist = prepare PDO
            $entityManager->persist($session);
            // flush = execute PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_session');
        }
        
        return $this->render('session/new.html.twig', [
            'addSessionForm' => $form,
            // 'edit' => $session->getId()
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, SessionRepository $sessionRepository): Response
    {
        $id = $session->getId();

        $stagiairesNonInscrits = $sessionRepository->getStagiairesNonInscrits($id);

        return $this->render('session/show.html.twig', [
            'session' => $session,
            'stagiairesNonInscrits' => $stagiairesNonInscrits,
        ]);
    }

    
    #[Route('/session/{id}/{idStagiaire}/add', name: 'add_stagiaire_to_session')]
    public function addStagiaire(Session $session,
    // MapEntity : nécessite un "use" en haut de la page, permet de donner le nom qu'on veut dans la variable d'objet ($stagiare),
    // le MapEntity fait le lien entre idStagiaire et le renomme en $stagiaire qu'on déclare après
    #[MapEntity(id: 'idStagiaire')] Stagiaire $stagiaire,
    StagiaireRepository $stagiaireRepository, EntityManagerInterface $entityManager)
    {
        // on utilise la méthode addStagiaire de l'entité Session en passant en paramètre l'objet $stagiaire
        $session->addStagiaire($stagiaire);
        // flush pour faire la requête qui va modifier la BDD
        $entityManager->flush();

        return $this->redirectToRoute('show_session', [
            'id' => $session->getId(),
        ]);
    }

    #[Route('/session/{id}/{idStagiaire}/remove', name: 'remove_stagiaire_from_session')]
    public function removeStagiaire(Session $session,
    #[MapEntity(id: 'idStagiaire')] Stagiaire $stagiaire,
    StagiaireRepository $stagiaireRepository, EntityManagerInterface $entityManager)
    {
        // on utilise la méthode removeStagiaire de l'entité Session en passant en paramètre l'objet $stagiaire
        $session->removeStagiaire($stagiaire);
        // persist pour que Symfony se rende compte qu'il y a un changement à faire en BDD
        $entityManager->persist($session);
        // flush pour faire la requête qui va modifier la BDD
        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }
}
