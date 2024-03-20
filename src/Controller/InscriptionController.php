<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;

class InscriptionController extends AbstractController
{
   #[Route('/inscription', name:'app_inscription')]
    public function creerInscription(Request $request):Response{
        $user = new User();
        $form = $this->createFormBuilder($user)
                ->add('numLicence', TextType::class) 
                ->add('Envoyer', SubmitType::class)
                ->getForm();
//        $form->handleRequest($request);
//        if($form->isSubmitted() && $form->isValid()){
//            $gestionContact->creerContact($contact);
//            $gestionContact->envoiMailContact($contact);
//            return $this->redirectToRoute("home_homepage");
//        }
        return $this->render('inscription/form_inscription.html.twig',
                [
                    'formUser'=>$form->createView(),
                  ]);
    }
}





