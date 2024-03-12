<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HotelRepository;
use App\Repository\AtelierRepository;
use App\Entity\Hotel;
use App\Entity\Atelier;
use App\Repository\VacationRepository;

class HomeController extends AbstractController {

    #[Route('/home', name: 'app_home')]
    public function index(HotelRepository $hotelRepository, AtelierRepository $atelierRepository, VacationRepository $vacationRepository): Response {
        // Récupérer tous les hôtels
        $hotels = $hotelRepository->findAll();

        // Récupérer tous les ateliers
        $ateliers = $atelierRepository->findAll();

        // Préparation des données pour les chambres et tarifs
        $chambresEtTarifs = [];
        foreach ($hotels as $hotel) {
            $chambresEtTarifs[$hotel->getId()] = $hotelRepository->findChambresEtTarifsParHotel($hotel->getId());
        }
        $vacations = $vacationRepository->findDistinctDateheureDebutAndFin();
        dump($vacations);

        // Rendu du template Twig en passant toutes les données récupérées
        return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'hotels' => $hotels,
                    'ateliers' => $ateliers,
                    'chambresEtTarifs' => $chambresEtTarifs,
                    'vacations' => $vacations
        ]);
    }

    // Assurez-vous d'avoir une vue ou un autre mécanisme pour afficher ou utiliser les données selon votre cas d'utilisation.
}
