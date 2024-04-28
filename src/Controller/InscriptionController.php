<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \App\Service\ApiDeserialize;
use App\Repository\AtelierRepository;
use App\Repository\HotelRepository;
use App\Repository\CategorieChambreRepository;
use App\Repository\NuiteRepository;
use App\Repository\RestaurationRepository;
use App\Controller\LoginController;
use App\Entity\Inscription;
use Doctrine\ORM\EntityManagerInterface;
use \App\Repository\ProposerRepository;
use App\Entity\Restauration;

class InscriptionController extends AbstractController {

    #[Route('/inscription', name: 'app_inscription')]
    public function formInscription(AtelierRepository $atelierRepository, ProposerRepository $proposerR, ApiDeserialize $des, LoginController $loginC, NuiteRepository $nuiteR, RestaurationRepository $restauR, HotelRepository $hotelR, CategorieChambreRepository $catR): Response {

        $numLicence = $this->getUser()->getNumlicence();
        $licencie = $des->getLicencieByNumLicence($numLicence);
        $ateliers = $atelierRepository->findAll();
        $club = $des->getClub($licencie->getId());
        $qualite = $des->getQualite($licencie->getIdQualite());

        $hotels = $hotelR->findAll();
        $categories = $catR->findAll();
        $distinctNuites = $nuiteR->findDistinctDateNuite();

        $proposers = $proposerR->findAll();
        $nuites = $nuiteR->findAll();

        $datesRestauration = $_ENV['datesCongres']; // dates en str
        $restaurationsBydate = $_ENV['optionsRestauration']; //tab[date]=[typesRepas]
        $typesRepas = $_ENV['typesRepas'];

        if ($this->getUser() != null && $this->getUser()->getInscription() == null) {

            return $this->render('inscription.html.twig', [
                        'controller_name' => 'InscriptionController',
                        'licencie' => $licencie,
                        'qualite' => $qualite,
                        'club' => $club,
                        'ateliers' => $ateliers,
                        'hotels' => $hotels,
                        'categories' => $categories,
                        'distinctNuites' => $distinctNuites,
                        'restaurations' => $restaurationsBydate,
                        'datesRestauration' => $datesRestauration,
                        'nuites' => $nuites,
                        'proposers' => $proposers,
                        'typesRepas' => $typesRepas
            ]);
        } else if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        } else if ($this->getUser()->getInscription() != null) {
            
            $is_inscription_enregistree=true;
            
            $inscription = $this->getUser()->getInscription();
            $nuitesChoisies = $inscription->getNuites();
            $restaurationsChoisies = $inscription->getRestaurations();
            $ateliersChoisis = $inscription->getAteliers();
            
            $restauChoisies = [];
            foreach ($restaurationsChoisies as $rC) {
                $restauChoisies[] = date('Y-m-d',$rC->getDateRestauration()->getTimestamp()) ."_". $rC->getTypeRepas() ;
            }

            
            return $this->render('inscription.html.twig', [
                        'ateliersChoisis' => $ateliersChoisis,
                        'nuitesChoisies' => $nuitesChoisies,
                        'restaurationsChoisies' => $restauChoisies,
                        'controller_name' => 'InscriptionController',
                        'licencie' => $licencie,
                        'qualite' => $qualite,
                        'club' => $club,
                        'ateliers' => $ateliers,
                        'hotels' => $hotels,
                        'categories' => $categories,
                        'distinctNuites' => $distinctNuites,
                        'restaurations' => $restaurationsBydate,
                        'datesRestauration' => $datesRestauration,
                        'nuites' => $nuites,
                        'proposers' => $proposers,
                        'typesRepas' => $typesRepas,
                'is_inscrit'=>$is_inscription_enregistree
            ]);
        }
    }

    #[Route('/EnregistrerInscription', name: 'app_enregistrer_inscription')]
    public function enregistrerInscription(AtelierRepository $atelierR, RestaurationRepository $restauR, NuiteRepository $nuiteR, EntityManagerInterface $em): Response {

        $ateliers = filter_input(INPUT_POST, 'ateliers', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $hebergements = filter_input(INPUT_POST, 'hebergements', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $restaurations = filter_input(INPUT_POST, 'restaurations', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        
        $inscription = new Inscription();

        foreach ($ateliers as $idAtelier) {
            $inscription->addAtelier($atelierR->find($idAtelier));
        }

        foreach ($restaurations as $restau) {
            $restau = explode('_', $restau);
            $restauration = new Restauration();
            $restauration->setDateRestauration(new \DateTime($restau[0]));
            $restauration->setTypeRepas($restau[1]);
            $em->persist($restauration);
            $inscription->addRestauration($restauration);
        }

        foreach ($hebergements as $nuite) {
            $inscription->addNuite($nuiteR->find($nuite));
        }

        $inscription->setDateinscription(new \DateTime('now'));
        $inscription->setUser($this->getUser());
        
        $em->persist($inscription);
        $em->flush();

        $this->addFlash('success', "Votre demande d'inscription a été enregistrée, vous allez recevoir un email de confirmation d'inscription.");

        return $this->redirectToRoute('app_inscription');
    }

//    public function new(Request $request): Response {
//        // creates a task object and initializes some data for this example
//        $task = new Task();
//        $task->setTask('Write a blog post');
//        $task->setDueDate(new \DateTimeImmutable('tomorrow'));
//
//        $form = $this->createFormBuilder($task)
//                ->add('task', TextType::class)
//                ->add('dueDate', DateType::class)
//                ->add('save', SubmitType::class, ['label' => 'Create Task'])
//                ->getForm();
//
//        // ...
//    }
}
