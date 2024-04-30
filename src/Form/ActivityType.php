<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActivityType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('activity', ChoiceType::class, [
                    'choices' => [
                        'atelier' => 'atelier',
                        'theme' => 'theme',
                        'vacation' => 'vacation'
                    ],
                    'expanded' => true
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
        ]);
    }
}
