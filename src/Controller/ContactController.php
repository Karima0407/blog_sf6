<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $contact=new Contact();
        $form=$this->createForm(ContactType::class ,$contact);

        $form->handleRequest($request);


       


        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contact' => $form->createView()
        ]);
        
    }
}