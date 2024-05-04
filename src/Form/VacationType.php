<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Atelier;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

class VacationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('atelier', EntityType::class, [
                    'class' => Atelier::class,
                    'expanded' => true, //il premtr de dire c'est si en mode bouton ou en mode selsect si true un bouton a cohcé si fauc un menu deroalnte 
                    'choice_label' => 'libelle',
                ])
                ->add('dateheureDebut', DateTimeType::class, [
                    'widget' => 'single_text'
                ])
                ->add('dateheureFin', DateTimeType::class, [
                    'widget' => 'single_text'
        ]);
        ;
        
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $dateheureDebut = $form->get('dateheureDebut')->getData();
            $dateheureFin = $form->get('dateheureFin')->getData();

            if ($dateheureDebut >= $dateheureFin) {
                $form->get('dateheureDebut')->addError(new FormError('La date de début doit être antérieure à la date de fin.'));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}
