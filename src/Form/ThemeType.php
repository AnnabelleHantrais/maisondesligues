<?php

namespace App\Form;

use App\Entity\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Atelier;
use Symfony\Component\Validator\Constraints\Count;

class ThemeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('libelle')
                ->add('ateliers', EntityType::class, [
                    'class' => Atelier::class,
                    'expanded' => true,
                    'multiple' => true,
                    'choice_label' => 'libelle',
                    'constraints' => [new Count(['min' => 1, 'minMessage' => 'Vous devez fournir au moins un theme'])
                        ]
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Theme::class,
        ]);
    }
}
