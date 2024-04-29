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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\User;
use Symfony\Component\Mime\Address;

class InscriptionController extends AbstractController {

    #[Route('/inscription', name: 'app_inscription')]
    public function formInscription(AtelierRepository $atelierRepository, ProposerRepository $proposerR, ApiDeserialize $des, MailerInterface $mailer, NuiteRepository $nuiteR,  HotelRepository $hotelR, CategorieChambreRepository $catR, EntityManagerInterface $em): Response {

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

        $variablesEnvoyees = [
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
        ];

        if ($this->getUser() != null && $this->getUser()->getInscription() == null) {
            
        } else if ($this->getUser()->getInscription() != null) {

          

            $is_inscription_enregistree = true;

            $inscription = $this->getUser()->getInscription();
            $isValidated = $inscription->isIsValidated();
            $nuitesChoisies = $inscription->getNuites();
            $restaurationsChoisies = $inscription->getRestaurations();
            $ateliersChoisis = $inscription->getAteliers();

            $restauChoisies = [];
            foreach ($restaurationsChoisies as $rC) {
                $restauChoisies[] = date('Y-m-d', $rC->getDateRestauration()->getTimestamp()) . "_" . $rC->getTypeRepas();
            }

            $variablesEnvoyees = array_merge($variablesEnvoyees, ['ateliersChoisis' => $ateliersChoisis,
                'nuitesChoisies' => $nuitesChoisies,
                'restaurationsChoisies' => $restauChoisies,
                'is_inscrit' => $is_inscription_enregistree,
                'is_validated' => $isValidated]);
            
            
              if (isset($_POST) && !empty($_POST)) {
//                  $variablesEnvoyees+=['montantInscription'=>$mon]
                $this->enregistrerInscription($atelierRepository, $mailer, $nuiteR, $em, $variablesEnvoyees);
            }
            
        } else if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('inscription.html.twig', $variablesEnvoyees);
    }

//    #[Route('/EnregistrerInscription', name: 'app_enregistrer_inscription')]
    private function enregistrerInscription(AtelierRepository $atelierR, MailerInterface $mailer, NuiteRepository $nuiteR, EntityManagerInterface $em, $variablesTwig): float{

        $prixInscription = '%env(TARIF_INSCRIPTION)%';
        $tarifParRepas = '%env(TARIF_RESTAURATION)%';
        $montantInscription = floatval($prixInscription);
        
        $ateliers = filter_input(INPUT_POST, 'ateliers', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $hebergements = filter_input(INPUT_POST, 'hebergements', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $restaurations = filter_input(INPUT_POST, 'restaurations', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $submit = filter_input(INPUT_POST, 'submit');

        if ($this->getUser() != null && $this->getUser()->getInscription() == null) {
            $inscription = new Inscription();
            $montantInscription = $this->fillInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);
        } else if ($this->getUser()->getInscription() != null) {
            $inscription = $this->getUser()->getInscription();
            $montantInscription = $this->modifierInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);
            if ($submit == 'Valider') {
                $inscription->setIsValidated(true);
                $em->persist($inscription);
                $em->flush();
            }
        }
        /**
         * *@TODO: envoi de mail avec le montant et le détail de l'inscription
         */
        $variablesTwig+=['montantInscription'=>$montantInscription];
        $this->sendInscriptionEmail($inscription->getUser(), $mailer, $variablesTwig);

        $this->addFlash('success', "Votre demande d'inscription a été enregistrée, vous allez recevoir un email de confirmation d'inscription.");

//        return $this->redirectToRoute('app_inscription');
        return $montantInscription;
    }

    //#[Route('/modifierInscription', name: 'app_modifier_inscription')]
    public function modifierInscription(AtelierRepository $atelierR, NuiteRepository $nuiteR, EntityManagerInterface $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, float $montantInscription): float {

        $this->resetInscription($inscription);
        $montantFinal = $this->fillInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);

        return $montantFinal;
    }

    private function resetInscription($inscription): void {

        foreach ($inscription->getAteliers() as $atelier) {
            $inscription->removeAtelier($atelier);
        }

        foreach ($inscription->getRestaurations() as $restauration) {
            $inscription->removeRestauration($restauration);
        }

        foreach ($inscription->getNuites() as $nuite) {
            $inscription->removeNuite($nuite);
        }
    }

    private function fillInscription(AtelierRepository $atelierR, NuiteRepository $nuiteR, EntityManagerInterface $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, float $montantInscription): float {

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
            $montantInscription += floatval($tarifParRepas);
        }
        foreach ($hebergements as $nuite) {
            $nuite = explode('_', $nuite);
            $idNuite = $nuite[0];
            $tarifNuite = floatval($nuite[1]);
            $montantInscription += floatval($tarifNuite);
            $inscription->addNuite($nuiteR->find($idNuite));
        }

        $inscription->setDateinscription(new \DateTime('now'));
        $inscription->setUser($this->getUser());
        $em->persist($inscription);
        $em->flush();

        return $montantInscription;
    }

    private function sendInscriptionEmail(User $user, MailerInterface $mailer, $variables ) {

      
        // generate a signed url and email it to the user
        $mailer->send(
                (new TemplatedEmail())
                        ->context($variables)
                        ->from(new Address('annabelle.hantrais@gmail.com', 'contact address'))
                        ->to($user->getEmail())
                        ->subject('Enregistrement de votre incription')
                        ->htmlTemplate('inscription/email_inscription.html.twig')
        );

        return $this->redirectToRoute('app_inscription');
    }

}
