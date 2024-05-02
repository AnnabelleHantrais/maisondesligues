<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AtelierRepository;
use App\Repository\VacationRepository;
use App\Entity\Atelier;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AtelierType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Vacation;
use App\Form\VacationType;
use Symfony\Component\Form\FormView;


class VacationController extends AbstractController {

    #[Route('/selectAtelier', name: 'app_select_atelier')]
    public function selectAtelier(AtelierRepository $atelierRepository): Response {
        $ateliers = $atelierRepository->findAll();
        return $this->render('vacation/index.html.twig', [
                    'ateliers' => $ateliers
        ]);
    }

    #[Route('/atelier/{id}', name: 'app_vacation')]
    public function recupVacation(VacationRepository $vacationRepository, int $id): Response {
        $atelier = $this->getDoctrine()->getRepository(Atelier::class)->find($id);
        if (!$atelier) {
            throw $this->createNotFoundException('No atelier found for id ' . $id);
        }
        $vacations = $vacationRepository->findBy(['atelier' => $atelier]);

        return $this->render('vacation/recupvacation.html.twig', [
                    'vacations' => $vacations,
                    'atelier' => $atelier
        ]);
    }

    #[Route('/vacation/{id}', name: 'edit_vacation')]
    public function editVacation(Vacation $vacation, EntityManagerInterface $entityManager,Request $request, $id ) {

        $builder = $this->createFormBuilder($vacation);
        $builder->add('dateheuredebut', DateTimeType::class, [
                'widget' => 'single_text'
            ])
                ->add('dateheurefin', DateTimeType::class, [
                'widget' => 'single_text'
            ]);
        $form = $builder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            $entityManager->flush(); // Sauvegarder les modifications dans la base de données
            $this->addFlash('success', 'La vacation a été mise à jour.');
            return $this->redirectToRoute('edit_vacation', ['id' => $vacation->getId()]);
        }
        //affichage de la vue 
        return $this->render('vacation/edit-vacation.html.twig', [
                    'vacation' => $vacation,
                    'form' => $form->createView(),
                    'id'=>$id
        ]);
    }

}
