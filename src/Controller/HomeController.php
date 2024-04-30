<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Licencie;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \App\Service\Deserialize;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\HotelRepository;
use App\Repository\AtelierRepository;
use App\Entity\Hotel;
use App\Entity\Atelier;
use App\Repository\VacationRepository;
use DoctrineExtensions\Query\Mysql\Date;

class HomeController extends AbstractController {

    #[Route('/', name: 'app_home')]
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
        $datesvacations = $vacationRepository->findDistinctDates();
//        dump($datesvacations);
//        dump($vacations);
//        dump($hotels);
        // Rendu du template Twig en passant toutes les données récupérées
        return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'hotels' => $hotels,
                    'ateliers' => $ateliers,
                    'chambresEtTarifs' => $chambresEtTarifs,
                    'vacations' => $vacations,
                    'datesvacations' => $datesvacations,
                //'form'=>$form
        ]);
    }

    #[Route('/licencies/{id}', name: 'app_licencies_id')]
    public function getLicencie($id, Deserialize $des): Response {
        $licencie = $des->getLicencie($id);
        return new Response($licencie->getId());
    }

    #[Route('/club/{id}', name: 'app_club_id')]
    public function getClub($id, Deserialize $des): Response {
        $club = $des->getClub($id);
        return new Response($club->getNom());
    }
}
