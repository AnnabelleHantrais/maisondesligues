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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use \Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionController extends AbstractController {

    #[Route('/inscription', name: 'app_inscription')]
    public function formInscription(): Response {
        $user = new \App\Entity\User();
        $form = $this->createFormBuilder($user)
                ->add('numlicencie', TextType::class)
                ->add('mdp', PasswordType::class)
                ->add('mdp', PasswordType::class)
//                ->add('dueDate', DateType::class)
//                ->add('save', SubmitType::class, ['label' => 'Create Task'])
                ->getForm();

        return $this->render('inscription.html.twig', [
                    'controller_name' => 'InscriptionController',
                    'form' => $form->createView(),
        ]);
    }

    public function new(Request $request): Response {
        // creates a task object and initializes some data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTimeImmutable('tomorrow'));

        $form = $this->createFormBuilder($task)
                ->add('task', TextType::class)
                ->add('dueDate', DateType::class)
                ->add('save', SubmitType::class, ['label' => 'Create Task'])
                ->getForm();

        // ...
    }

}
