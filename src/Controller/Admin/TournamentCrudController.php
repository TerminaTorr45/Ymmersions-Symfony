<?php

namespace App\Controller\Admin;

use App\Entity\Tournament;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class TournamentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tournament::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // ID du tournoi
            IdField::new('id')->onlyOnIndex(),
            
            // Nom du tournoi
            TextField::new('name')->setLabel('Nom du tournoi')->setRequired(true),
            
            // Date de début des inscriptions
            DateTimeField::new('registrationStartDate')->setLabel('Début des inscriptions')->setRequired(true),
            
            // Date de fin des inscriptions
            DateTimeField::new('registrationEndDate')->setLabel('Fin des inscriptions')->setRequired(true),
            
            // Date de début du tournoi
            DateTimeField::new('startDate')->setLabel('Date de début')->setRequired(true),
            
            // Nombre maximal d'équipes
            IntegerField::new('maxTeams')->setLabel('Équipes maximales')->setRequired(true),
            
            // Nombre de joueurs par équipe
            IntegerField::new('playersPerTeam')->setLabel('Joueurs par équipe')->setRequired(true),
            
            // Statut du tournoi
            ChoiceField::new('status')
                ->setLabel('Statut')
                ->setChoices([
                    'À venir' => 'À venir',
                    'En cours' => 'En cours',
                    'Terminé' => 'Terminé',
                ])
                ->setRequired(true),
        ];
    }
}
    