<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class LoginController extends AbstractController {

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authUtils): Response {
        
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        $error = $authUtils->getLastAuthenticationError();
//        $user = new \App\Entity\User();
          $lastUsername = $authUtils->getLastUsername();
//        $form = $this->createFormBuilder($user)
//                ->add('numlicence', TextType::class)
//                ->add('password', PasswordType::class)
//                ->add('submit', SubmitType::class)
//                
//                ->getForm();

        return $this->render('login/login.html.twig', [
                    'last_username' => $lastUsername,
//                    'form' => $form->createView(),
                    'error' => $error
        ]);
    }
    
     #[Route('/logout', name: 'app_logout')]
     public function logout():Response{
         return $this->redirectToRoute('app_login');
         
     }

}
