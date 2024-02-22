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

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    

    #[Route('/licencies/{id}', name: 'app_licencies_id')]     
    public function getLicencie($id , Deserialize $des):Response
    {
       $licencie = $des->getLicencie($id);
       return new Response($licencie->getId());  
    }
    
    #[Route('/club/{id}', name: 'app_club_id')]     
    public function getClub($id , Deserialize $des):Response
    {
       $club = $des->getClub($id);
       return new Response($club->getNom());
    }
}
