<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, EntityManagerInterface $entityManager , UserPasswordHasherInterface $passwordHasher ): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        dd($request);
        if ($form->isSubmitted() && $form->isValid()) {

              $plaintextPassword =$user->getPassword();
              $hashedPassword=$passwordHasher->hashPassword(
                $user,
                $plaintextPassword
              );

              $user->setPassword($hashedPassword);

          
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("app_home");

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');
        }
        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
            'user' => $form->createView()
        ]);
    }

    
}
