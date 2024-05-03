<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ActivityType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ThemeType;
use App\Form\AtelierType;
use App\Entity\Vacation;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Atelier;
use App\Entity\Theme;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AjouterateliersController extends AbstractController {

    #[Route('/ajouterateliers', name: 'app_ajouterateliers')]
    public function index(Request $request): Response {

        $form = $this->createForm(ActivityType::class);
        $form->handleRequest($request); //c'est y des valeur dans le dollar il valider le formualire si j'ai bien passeé les bonne valeurs 

        if ($form->isSubmitted() && $form->isValid()) {//si les info sont validé ben tu va me faire tel truc 
            $activity = $form->getData()['activity']; //on va reucpere la valeur le personne à saisi ex : lui a choisi theme ben on le suara 

            if ($activity == 'theme') {
                return $this->redirectToRoute('app_creationtheme');
            } else if ($activity == 'vacation') {
                return $this->redirectToRoute('app_creationvacation');
            } else if ($activity == 'atelier') {
                return $this->redirectToRoute('app_creationatelier');
            }
        }
        return $this->renderForm('ajouterateliers/index.html.twig', [
                    'form' => $form,
        ]);
    }

    #[Route('/creationtheme', name: 'app_creationtheme')]
    public function formTheme(Request $request, EntityManagerInterface $entityManager, \App\Repository\AtelierRepository $atelierR): Response {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);

        $form->handleRequest($request); //c'est y des valeur dans le dollar il valider le formualire si j'ai bien passeé les bonne valeurs 
        if ($form->isSubmitted() && $form->isValid()) {//si les info sont validé ben tu va me faire tel truc 
            $entityManager->persist($theme); //c'est un turc qui permt de dire doctrien prendre en compte cet objet si ileest nouveau il va le cree siono il va le mettre à jour 
            $entityManager->flush();

            $this->addFlash('success', 'Le thème a bien été créé.');
        }

        return $this->renderForm('ajouterateliers/theme_form.html.twig', [
                    'form' => $form,
        ]);
    }

    #[Route('/creationvacation', name: 'app_creationvacation')]
    public function formVacation(Request $request, EntityManagerInterface $entityManager): Response {
        $vacation = new Vacation();
        $builder = $this->createFormBuilder($vacation);
        $builder->add('dateheuredebut', DateTimeType::class, ['widget' => 'single_text'])
                ->add('dateheurefin', DateTimeType::class, ['widget' => 'single_text']);
        $builder->add('atelier', EntityType::class, [
            'class' => Atelier::class,
            'choice_label' => 'libelle',
        ]);

        $form = $builder->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {//si les info sont validé ben tu va me faire tel truc 
            $entityManager->persist($vacation); //c'est un turc qui permt de dire doctrien prendre en compte cet objet si ileest nouveau il va le cree siono il va le mettre à jour 
            $entityManager->flush();

            $this->addFlash('success', 'La vacation a bien été créée.');
        }


        return $this->render('ajouterateliers/vacation_form.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    #[Route('/creationatelier', name: 'app_creationatelier')]
    public function formAtelier(Request $request, EntityManagerInterface $entityManager): Response {
        $atelier = new Atelier();
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request); //c'est y des valeur dans le dollar il valider le formualire si j'ai bien passeé les bonne valeurs 

        if ($form->isSubmitted() && $form->isValid()) {//si les info sont validé ben tu va me faire tel truc 
            $entityManager->persist($atelier); //c'est un turc qui permt de dire doctrien prendre en compte cet objet si ileest nouveau il va le cree siono il va le mettre à jour 
            $entityManager->flush();

            $this->addFlash('success', "L'atelier a bien été créé.");
        }


        return $this->renderForm('ajouterateliers/atelier_form.html.twig', [
                    'form' => $form,
        ]);
    }

}
