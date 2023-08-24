<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }

    // #[Route('/entreprise/{id}', name: 'show_entreprise')]
    // public function show(Entreprise $entreprise) : Response
    // {
    //     return $this->render('entreprise/show.html.twig', [
    //         'entreprise' => $entreprise,
    //     ]);
    // }

    // requête pour avoir la date la plus proche:
    // SELECT date_debut
    // FROM session
    // WHERE date_debut > CURDATE() & formation_id = :id
    // ORDER BY date_debut ASC
    // LIMIT 1;

    // peut-être faisable comme ça
    // $closestSession = $sessionRepository->findBy(["date_debut" => "CURDATE() AND formation_id = $id"], ["date_debut" => "ASC"], 1);        

}
