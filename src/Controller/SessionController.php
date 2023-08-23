<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use App\Repository\ProgrammeRepository;
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

    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, ProgrammeRepository $programmeRepository): Response
    {   
        $programmes = $programmeRepository->findBy(["session" => $session->getId()], []);

        return $this->render('session/show.html.twig', [
            'session' => $session,
            'programmes' => $programmes,
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
