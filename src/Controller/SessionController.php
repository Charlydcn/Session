<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(FormationRepository $formationRepository): Response
    {
        // $sessions = $sessionRepository->findBy([], ["dateDebut" => "ASC"]);
        $formations = $formationRepository->findBy([], ["intitule" => "ASC"]);

        return $this->render('session/index.html.twig', [
            // 'sessions' => $sessions,
            'formations' => $formations,
        ]);
    }

    // requête pour avoir la date la plus proche:
    // SELECT date_debut
    // FROM session
    // WHERE date_debut > CURDATE() & formation_id = :id
    // ORDER BY date_debut ASC
    // LIMIT 1;

    // peut-être faisable comme ça
    // $closestSession = $sessionRepository->findBy(["date_debut" => "CURDATE() AND formation_id = $id"], ["date_debut" => "ASC"], 1);        

}
