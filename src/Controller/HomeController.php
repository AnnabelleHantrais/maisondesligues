<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HotelRepository;
use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Hotel;

class HomeController extends AbstractController {

    #[Route('/home', name: 'app_home')]
    public function index(ManagerRegistry $doctrine): Response {
//        $hotelRepo = new HotelRepository();

        $hotels = $doctrine
                ->getRepository(Hotel::class)
                ->findAll();

        return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
                    'hotels' => $hotels
        ]);
    }

    #[Route('/tati', name: 'tati')]
    public function list(ManagerRegistry $doctrine): Response {
        //récupérer tous les id hotels
        //foreach ($idhotels as $hotelId
        // Assurez-vous que la méthode findChambresEtTarifsParHotel est définie dans le HotelRepository
        $hotelRepository = $doctrine->getRepository(Hotel::class);
        
        $hotels = $hotelRepository->findAll();
        var_dump($hotelRepository->findChambresEtTarifsParHotel(1));
       foreach($hotels as $hotel) {
//           var_dump($hotel->getId());
    $chambresEtTarifs[$hotel->getId()] = $hotelRepository->findChambresEtTarifsParHotel($hotel->getId());
    
    }
//    var_dump($chambresEtTarifs);


        // Rendu du template Twig en passant les données récupérées
        return $this->render('home/index.html.twig', [
            'chambresEtTarifs' => $chambresEtTarifs,
            'hotels' => $hotels
        ]);
    }

    /*
     * 

      #[Route('/home', name: 'app_home')]
      public function recuphotel($param) {
      return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'hotels' => $hotels
      }
     * 
     * 
     */
    
    #[Route('/ateliers', name: 'app_ateliers')]
    public function displayAteliers(ManagerRegistry $doctrine): Response {
        
        $ateliers = $doctrine
                ->getRepository(Atelier::class)
                ->findAll();

        return $this->render('home/ateliers.html.twig', [
                    'controller_name' => 'HomeController',
                    'ateliers' => $ateliers
        ]);
    }
    
}
