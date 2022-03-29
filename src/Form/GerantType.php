<?php

namespace App\Form;

use App\Entity\Gerant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GerantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('creePar')
            ->add('creeLe')
            ->add('modifiePar')
            ->add('modifieLe')
            ->add('enable')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('nom_utilisateur')
            ->add('mot_de_passe')
            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gerant::class,
        ]);
    }
}
