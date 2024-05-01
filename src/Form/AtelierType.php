<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AtelierType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('themes', EntityType::class, [
                    'class' => Theme::class,
                    'expanded' => true,
                    'multiple' => true,
                    'choice_label' => 'libelle'
                ])
                ->add('libelle')
                ->add('nbPlacesMaxi')
              //  ->add('themes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
