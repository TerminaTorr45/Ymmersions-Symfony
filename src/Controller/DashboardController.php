<?php

namespace App\Controller;

use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(TournamentRepository $tournamentRepository): Response
    {
        $tournaments = $tournamentRepository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'tournaments' => $tournaments,
        ]);
    }
}
