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
use App\Entity\Vacation;
use App\Form\VacationType;
use Symfony\Component\Form\FormView;


class AtelierController extends AbstractController {

    #[Route('/atelier', name: 'app_atelier')]
    public function index(AtelierRepository $atelierRepository): Response {
        $ateliers = $atelierRepository->findAll();
        return $this->render('atelier/index.html.twig', [
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
        return $this->render('atelier/recupvacation.html.twig', [
                    'vacations' => $vacations,
                    'atelier' => $atelier
        ]);
    }

    #[Route('/vacation/{id}', name: 'edit_vacation')]
    public function editVacation(VacationRepository $vacationRepository, Vacation $vacation, EntityManagerInterface $entityManager,Request $request ) {

        $form = $this->createForm(VacationType::class, $vacation );
        $form->remove('atelier');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush(); // Sauvegarder les modifications dans la base de données

            $this->addFlash('success', 'L\'vacation a été mis à jour.');
            return $this->redirectToRoute('edit_vacation', ['id' => $vacation->getId()]);

        }
        //il vviens affiche le parti visuale  de la page 
        return $this->renderform('home/formvacation.html.twig', [
                    'vacation' => $vacation,
                     'form'=>$form
        ]);
    }
}
