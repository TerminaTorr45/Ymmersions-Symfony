<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function profil(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser(); // Récupère l'utilisateur connecté
        
        // Crée un formulaire basé sur la classe de formulaire
        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe s'il est modifié
            $plainPassword = $form->get('password')->getData();
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }

            // Sauvegarde les changements en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Ajoute un message flash
            $this->addFlash('success', 'Profil mis à jour avec succès !');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('user/profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
