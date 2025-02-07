<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use App\Entity\Team;
use App\Form\TeamType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TeamController extends AbstractController
{
    #[Route('/equipe/rejoindre/{id}', name: 'app_team_join')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function join(int $id, TeamRepository $teamRepository, EntityManagerInterface $entityManager): RedirectResponse
    {
        $team = $teamRepository->find($id);
        $user = $this->getUser();

        if (!$team) {
            throw $this->createNotFoundException('Équipe non trouvée.');
        }

        // Vérifier si l'utilisateur est déjà dans l'équipe
        if ($team->getPlayers()->contains($user)) {
            $this->addFlash('danger', 'Vous êtes déjà membre de cette équipe.');
            return $this->redirectToRoute('app_team_list');
        }

        // Vérifier si l'utilisateur est le créateur de l'équipe
        if ($team->getOwner() === $user) {
            $this->addFlash('danger', 'Vous ne pouvez pas rejoindre une équipe que vous avez créée.');
            return $this->redirectToRoute('app_team_list');
        }

        // Ajouter l'utilisateur à l'équipe
        $team->addPlayer($user);

        $entityManager->persist($team);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez rejoint l\'équipe avec succès !');

        return $this->redirectToRoute('app_team_list');
    }

    #[Route('/equipes', name: 'app_team_list')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function list(TeamRepository $teamRepository): Response
    {
        $teams = $teamRepository->findAll();

        return $this->render('team/index.html.twig', [
            'teams' => $teams,
        ]);
    }

    #[Route('/equipe/creer', name: 'app_team_create')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team->setOwner($this->getUser());
            $team->setPlayersCount(1);

            $entityManager->persist($team);
            $entityManager->flush();

            $this->addFlash('success', 'Équipe créée avec succès !');

            return $this->redirectToRoute('app_team_list');
        }

        return $this->render('team/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
