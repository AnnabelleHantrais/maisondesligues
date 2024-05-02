<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use \App\Service\ApiDeserialize;

class RegistrationController extends AbstractController {

    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier) {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, ApiDeserialize $des): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $numLicence = $form['numlicence']->getData();
            $licencie = $des->getLicencieByNumLicence($numLicence);

            if ($licencie) {
                $email = $licencie->getMail();
                $user->setEmail($email);
                $this->setUserPassword($userPasswordHasher, $entityManager, $user, $form);
                $this->handleEmail($user);
                $this->addFlash('success', "Votre compte a bien été créé, vous allez recevoir un email de vérification.");
                return $this->redirectToRoute('app_home');
            }else{
                $this->addFlash('danger', "Le numéro de licence saisi ne correspond à aucune licence enregistrée.");
//                return $this->redirectToRoute('app_register');
            }
        }

        return $this->render('registration/register.html.twig', [
                    'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, EntityManagerInterface $entityManager): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
            //update isVerified à true et persist
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        $this->getUser()->setIsVerified(true);
        $entityManager->persist($this->getUser());
        $entityManager->flush();
        
        $this->addFlash('success', ' Votre email a bien été vérifié.');

        return $this->redirectToRoute('app_login');
    }

    
    private function setUserPassword(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager,$user,$form){
        
         // encode the plain password
        $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                )
        );

        $entityManager->persist($user);
        $entityManager->flush();
        
    }
    private function handleEmail( User $user) {
       
        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                        ->from(new Address('contact@mdl.com', 'contact address'))
                        ->to($user->getEmail()) 
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
        );

        return $this->redirectToRoute('app_login');
    }

}
