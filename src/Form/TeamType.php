<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ pour saisir le nom de l'équipe
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'équipe',
            ])
            // Champ pour sélectionner le tournoi (liste déroulante)
            ->add('tournament', EntityType::class, [
                'class' => Tournament::class,
                'choice_label' => 'name', // Retourne directement le nom du tournoi
                'label' => 'Tournoi',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
