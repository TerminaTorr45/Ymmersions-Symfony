<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class GameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Game::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('teamA', 'Équipe A')->autocomplete(),
            AssociationField::new('teamB', 'Équipe B')->autocomplete(),
            IntegerField::new('scoreA', 'Score Équipe A')->setRequired(false),
            IntegerField::new('scoreB', 'Score Équipe B')->setRequired(false),
            DateTimeField::new('gameDate', 'Date du match'),
            AssociationField::new('tournament', 'Tournoi')->autocomplete(),
        ];
    }
}
