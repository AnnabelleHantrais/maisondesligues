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
use App\Repository\VacationRepository;
use App\Entity\Inscription;
use Doctrine\ORM\EntityManagerInterface;
use \App\Repository\ProposerRepository;
use App\Entity\Restauration;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\User;
use Symfony\Component\Mime\Address;
use \App\Repository\InscriptionRepository;

class InscriptionController extends AbstractController {

    #[Route('/inscription', name: 'app_inscription')]
    #[Security("is_granted('ROLE_INSCRIT')")]
    public function formInscription(VacationRepository $vacationR, AtelierRepository $atelierRepository, ProposerRepository $proposerR, ApiDeserialize $des, MailerInterface $mailer, NuiteRepository $nuiteR, HotelRepository $hotelR, CategorieChambreRepository $catR, EntityManagerInterface $em, InscriptionRepository $iR): Response {

        $variablesEnvoyees = $this->variablesFormulaireDeCreation($vacationR, $atelierRepository, $proposerR, $des, $mailer, $nuiteR, $hotelR, $catR, $em);
        $montantInscription = 0;

        if ($this->getUser()->getInscription() == null) {
            $isPremierEnregistrement = (isset($_POST) && !empty($_POST) && $_POST['submit'] == 'Enregistrer');

            if ($isPremierEnregistrement) {

                if (empty($this->getFormValues()['ateliers'])) {
                    $this->addFlash('danger', "Vous devez vous inscrire à au moins un atelier");
                    return $this->redirectToRoute('app_inscription');
                } else if (sizeof($this->getFormValues()['ateliers']) > $variablesEnvoyees['nbVacations']) {
                    $this->addFlash('danger', "Vous ne pouvez vous inscrire qu'à " . $variablesEnvoyees['nbVacations'] . ' ateliers maximum. ');
                    return $this->redirectToRoute('app_inscription');
                }

                $montantInscription = $this->enregistrerInscription($atelierRepository, $nuiteR, $em);
                $variablesEnvoyees = $this->variablesAddChoixInscription($variablesEnvoyees);
                $variablesEnvoyees += ['montantInscription' => $montantInscription];
                $this->sendInscriptionEmail($this->getUser(), $mailer, $variablesEnvoyees);
                $this->addFlash('success', "Votre demande d'inscription a été enregistrée , vous allez recevoir un email de confirmation d'inscription.");
            } else {
                //envoi formulaire vide
            }
        } else {
            //validation ou abandon de l'inscription
            $isValidation = (isset($_POST) && !empty($_POST) && $_POST['submit'] == 'Valider');
            $isAbandon = (isset($_POST) && !empty($_POST) && $_POST['submit'] == 'Abandonner');

            if ($isValidation) {
                if (empty($this->getFormValues()['ateliers'])) {
                    $this->addFlash('danger', "Vous devez vous inscrire à au moins un atelier");
                    return $this->redirectToRoute('app_inscription');
                } else if (sizeof($this->getFormValues()['ateliers']) > $variablesEnvoyees['nbVacations']) {
                    $this->addFlash('danger', "Vous ne pouvez vous inscrire qu'à " . $variablesEnvoyees['nbVacations'] . ' ateliers maximum. ');
                    return $this->redirectToRoute('app_inscription');
                }
                $montantInscription = $this->enregistrerInscription($atelierRepository, $nuiteR, $em, $isValidation);
                $variablesEnvoyees = $this->variablesAddChoixInscription($variablesEnvoyees);
                $variablesEnvoyees += ['montantInscription' => $montantInscription];
                $this->sendInscriptionEmail($this->getUser(), $mailer, $variablesEnvoyees);
                $this->addFlash('success', "Votre demande d'inscription a été validée , vous allez recevoir un email de validation d'inscription.");
            } else if ($isAbandon) {
                $this->abandonnerInscription($em, $iR);
            } else {
                //inscription déjà validée ou enregistrée et on revient dessus
                $inscription = $this->getUser()->getInscription();
                $variablesEnvoyees = $this->variablesAddChoixInscription($variablesEnvoyees);
                $montantInscription = $this->calculeMontantInscription($inscription->getNuites(), $inscription->getRestaurations(), $_ENV['typesRepas'], $proposerR);
                $variablesEnvoyees += ['montantInscription' => $montantInscription];
            }
        }

        return $this->render('inscription/inscription.html.twig', $variablesEnvoyees);
    }

    /**
     * 
     * @param AtelierRepository $atelierRepository
     * @param ProposerRepository $proposerR
     * @param ApiDeserialize $des
     * @param MailerInterface $mailer
     * @param NuiteRepository $nuiteR
     * @param HotelRepository $hotelR
     * @param CategorieChambreRepository $catR
     * @param EntityManagerInterface $em
     * @return type
     */
    private function variablesFormulaireDeCreation(VacationRepository $vacationR, AtelierRepository $atelierRepository, ProposerRepository $proposerR, ApiDeserialize $des, MailerInterface $mailer, NuiteRepository $nuiteR, HotelRepository $hotelR, CategorieChambreRepository $catR, EntityManagerInterface $em) {
        $user = $this->getUser();
        $numLicence = $user->getNumlicence();
        $licencie = $des->getLicencieByNumLicence($numLicence);
        $ateliers = $this->getAteliersDispo($atelierRepository);
        $club = $des->getClub($licencie->getId());
        $qualite = $des->getQualite($licencie->getIdQualite());

        $hotels = $hotelR->findAll();
        $categories = $catR->findAll();
        $distinctNuites = $nuiteR->findDistinctDateNuite();
        $nbVacations = sizeof($vacationR->findDistinctDateheureDebutAndFin());

        $proposers = $proposerR->findAll();
        $nuites = $nuiteR->findAll();

        $datesRestauration = $_ENV['datesCongres']; // dates en str
        $restaurationsBydate = $_ENV['optionsRestauration']; //tab[date]=[typesRepas]
        $typesRepas = $_ENV['typesRepas'];
        $tarifParRepas = '%env(TARIF_RESTAURATION)%';

        $variablesEnvoyees = [
            'user' => $user,
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
            'tarifParRepas' => $tarifParRepas,
            'nbVacations' => $nbVacations
        ];

        return $variablesEnvoyees;
    }

    /**
     * Retourne les nuites, restaurations et ateliers choisis
     * @param array $variablesDeBase
     * @return array
     */
    private function variablesAddChoixInscription(array $variablesDeBase): array {
        //inscription existante
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

        $variablesEnvoyees = array_merge($variablesDeBase,
                ['ateliersChoisis' => $ateliersChoisis,
                    'nuitesChoisies' => $nuitesChoisies,
                    'restaurationsChoisies' => $restaurationsChoisies,
                    'restaurationsChoisiesSTR' => $restauChoisies,
                    'is_inscrit' => $is_inscription_enregistree,
                    'is_validated' => $isValidated
        ]);

        return $variablesEnvoyees;
    }

    /**
     * Fonction qui récupère les données du formulaire d'inscription (en POST) et qui selon le cas  crée, modifie ou valide une inscription.
     * @param AtelierRepository $atelierR
     * @param MailerInterface $mailer
     * @param NuiteRepository $nuiteR
     * @param EntityManagerInterface $em
     * @param array $variablesTwig
     * @return float
     */
    private function enregistrerInscription(AtelierRepository $atelierR, NuiteRepository $nuiteR, EntityManagerInterface $em, $isValidation = false): float {

        $tarifParRepas = $this->getParameter('tarifRestauration');
        $montantInscription = floatval($this->getParameter('tarifInscription'));

        $formValues = $this->getFormValues();
        $ateliers = $formValues['ateliers'];

        $hebergements = $formValues['hebergements'];
        $restaurations = $formValues['restaurations'];
        $email = $formValues['email'];

        $this->getUser()->setEmail($email);
        $em->persist($this->getUser());

        if ($isValidation) {
            //récupère l'inscription de l'utilisateur
            $inscription = $this->getUser()->getInscription();
            //modifie l'inscription au cas où des modifications ont été apportées et retourne le montant final de l'inscription
            $montantInscription = $this->modifierInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);

            //passe l'inscription à 'validée'
            $inscription->setIsValidated(true);

            $em->persist($inscription);
            $em->flush();
        } else {
            $inscription = new Inscription();
            $montantInscription = $this->fillInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);
        }

        return $montantInscription;
    }

    /**
     * Fonction qui vide l'inscription de ses nuites, restaurations et ateliers, qui met l'inscription de l'utilisateur à null et qui supprime l'inscription.
     * @param EntityManagerInterface $em
     * @param InscriptionRepository $iR
     * @return void
     */
    private function abandonnerInscription(EntityManagerInterface $em, InscriptionRepository $iR): void {
        $user = $this->getUser();
        $inscription = $user->getInscription();
        $inscriptionId = $inscription->getId();

        $this->resetInscription($inscription, $em);
        $em->flush();
        $user->setInscription(null);
        $em->flush();
        $em->persist($inscription);

        if ($user->getInscription() == null) {
            $iR->delete($inscriptionId);
            $em->flush();
        }
    }

    /**
     * Fonction qui modifie un objet de la classe Inscription : vide tous ses attributs et les re-remplit avec les données passées en paramètres.
     * @param AtelierRepository $atelierR
     * @param NuiteRepository $nuiteR
     * @param EntityManagerInterface $em
     * @param type $ateliers
     * @param type $hebergements
     * @param type $restaurations
     * @param type $inscription
     * @param type $tarifParRepas
     * @param float $montantInscription
     * @return float
     */
    private function modifierInscription(AtelierRepository $atelierR, NuiteRepository $nuiteR, EntityManagerInterface $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, float $montantInscription): float {

        $this->resetInscription($inscription, $em);
        $montantFinal = $this->fillInscription($atelierR, $nuiteR, $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, $montantInscription);

        return $montantFinal;
    }

    /**
     * Fonction qui remet les ateliers, nuites et restaurations d'une inscription  à zero.
     * @param Inscription $inscription
     * @return void
     */
    private function resetInscription(Inscription $inscription, EntityManagerInterface $em): void {

        foreach ($inscription->getAteliers() as $atelier) {
            $inscription->removeAtelier($atelier);
        }

        foreach ($inscription->getRestaurations() as $restauration) {
            $inscription->removeRestauration($restauration);
            $em->remove($restauration);
        }

        foreach ($inscription->getNuites() as $nuite) {
            $inscription->removeNuite($nuite);
        }

        $em->flush();
    }

    /**
     * Fonction qui affecte à un objet Inscription ses atliers, nuites, restaurations
     * @param AtelierRepository $atelierR
     * @param NuiteRepository $nuiteR
     * @param EntityManagerInterface $em
     * @param array $ateliers tableau d'objets de la classe Atelier
     * @param array $hebergements  avec éléments au format "id_tarif" par exemple "1_95"
     * @param array$restaurations avec éléments au au format "YYYY-mm-dd_typeRepas"
     * @param type $inscription
     * @param type $tarifParRepas
     * @param float $montantInscription
     * @return float
     */
    private function fillInscription(AtelierRepository $atelierR, NuiteRepository $nuiteR, EntityManagerInterface $em, $ateliers, $hebergements, $restaurations, $inscription, $tarifParRepas, float $montantInscription): float {


        foreach ($ateliers as $idAtelier) {
            $inscription->addAtelier($atelierR->find($idAtelier));
        }
        if (!empty($restaurations)) {
            foreach ($restaurations as $restau) {
                $restau = explode('_', $restau);
                $restauration = new Restauration();
                $restauration->setDateRestauration(new \DateTime($restau[0]));
                $restauration->setTypeRepas($restau[1]);
                $em->persist($restauration);
                $inscription->addRestauration($restauration);
                $montantInscription += floatval($tarifParRepas);
            }
        }

        if (!empty($hebergements)) {
            foreach ($hebergements as $nuite) {
                $nuite = explode('_', $nuite);
                $idNuite = $nuite[0];
                $tarifNuite = floatval($nuite[1]);
                $montantInscription += floatval($tarifNuite);
                $inscription->addNuite($nuiteR->find($idNuite));
            }
        }


        $inscription->setDateinscription(new \DateTime('now'));
        $inscription->setUser($this->getUser());
        $em->persist($inscription);
        $em->flush();

        return $montantInscription;
    }

    /**
     * Fonction qui calcule le montant dû pour une inscription dont les restaurations, nuites sont passés en paramètres.
     * @param type $nuites
     * @param type $restaurations
     * @param type $tarifParRepas
     * @param ProposerRepository $proposerR
     * @return float
     */
    private function calculeMontantInscription($nuites, $restaurations, $tarifParRepas, ProposerRepository $proposerR): float {

        $montantInscription = $this->getParameter('tarifInscription');

        foreach ($restaurations as $restauration) {
            $montantInscription += floatval($tarifParRepas);
        }
        foreach ($nuites as $nuite) {
            $categorieId = $nuite->getCategorie();
            $hotelId = $nuite->getHotel();
            $tarifNuite = $proposerR->findProposerByNuiteAndHotel($categorieId, $hotelId)->getTarifNuite();
            $montantInscription += floatval($tarifNuite);
        }

        return $montantInscription;
    }

    /**
     * Fonction qui envoie un mail de confirmation d'inscription.
     * @param User $user
     * @param MailerInterface $mailer
     * @param type $variables
     * @return type
     */
    private function sendInscriptionEmail(User $user, MailerInterface $mailer, $variables) {

        $isValidated = $this->getUser()->getInscription()->isIsValidated();
        $subject = $isValidated ? "Validation de votre incription" : "Enregistrement de votre incription";
        $mailer->send(
                (new TemplatedEmail())
                        ->context($variables)
                        ->from(new Address('annabelle.hantrais@gmail.com', 'contact address'))
                        ->to($user->getEmail())
                        ->subject($subject)
                        ->htmlTemplate('inscription/email_inscription.html.twig')
        );

        return $this->redirectToRoute('app_inscription');
    }

    /**
     * Fonction qui récupère les ateliers dans lesquels il reste des places.
     * @param AtelierRepository $atelierR
     * @return array
     */
    private function getAteliersDispo(AtelierRepository $atelierR): array {

        $ateliers = $atelierR->findAll();
        $ateliersDispo = [];

        foreach ($ateliers as $atelier) {
            $nbPlacesMaxi = $atelier->getNbPlacesMaxi();

            $nbInscriptions = 0;

            foreach ($atelier->getInscriptions() as $ins) {
                $nbInscriptions += 1;
            }

            if ($nbInscriptions < $nbPlacesMaxi) {
                $ateliersDispo[] = $atelier;
            }
        }

        return $ateliersDispo;
    }

    /**
     * Fonction qui récupère l'email du licencie, les ateliers, les restaurations et les nuites saisies dans le formulaire en POST.
     * @return array
     */
    private function getFormValues(): array {

        $ateliers = filter_input(INPUT_POST, 'ateliers', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $hebergements = filter_input(INPUT_POST, 'hebergements', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $restaurations = filter_input(INPUT_POST, 'restaurations', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
        $email = filter_input(INPUT_POST, 'licencie-email', FILTER_SANITIZE_STRING);

        return [
            'ateliers' => $ateliers,
            'hebergements' => $hebergements,
            'restaurations' => $restaurations,
            'email' => $email
        ];
    }

}
