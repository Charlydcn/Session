<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Programme;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    #[Route('/programme', name: 'app_programme')]
    public function index(): Response
    {
        return $this->render('programme/index.html.twig', [
            'controller_name' => 'ProgrammeController',
        ]);
    }

    #[Route('/session/{id}/{sessionId}/remove_module', name: 'remove_module_from_session')]
    public function removeModule(Programme $programme, 
    #[MapEntity(id: 'sessionId')] Session $session,
    EntityManagerInterface $entityManager, ProgrammeRepository $programmeRepository)
    {
        $entityManager->remove($programme);
        $entityManager->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }
}
