<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController {

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authUtils): Response {
        
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }
        $error = $authUtils->getLastAuthenticationError();
          $lastUsername = $authUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
                    'last_username' => $lastUsername,
                    'error' => $error
        ]);
    }
    
     #[Route('/logout', name: 'app_logout')]
     public function logout():Response{
         return $this->redirectToRoute('app_login');
         
     }
     
     

}
